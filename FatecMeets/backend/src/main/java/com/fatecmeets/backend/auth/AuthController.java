package com.fatecmeets.backend.auth;

import com.fatecmeets.backend.email.EmailService;
import com.fatecmeets.backend.token.TokenService;
import com.fatecmeets.backend.user.User;
import com.fatecmeets.backend.user.UserRepository;
import lombok.Data;
import lombok.RequiredArgsConstructor;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.util.StringUtils;
import org.springframework.web.bind.annotation.*;

import java.security.SecureRandom;
import java.time.Instant;
import java.time.temporal.ChronoUnit;
import java.util.Map;
import java.util.UUID;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;

@RestController
@RequestMapping("/api/auth")
@RequiredArgsConstructor
public class AuthController {

  private final UserRepository users;
  private final PasswordEncoder encoder;
  private final EmailService emailService;
  private final TokenService tokenService;

  private static final SecureRandom RNG = new SecureRandom();
  private static final Logger log = LoggerFactory.getLogger(AuthController.class);

  private static final int LOGIN_TOKEN_MAX_ATTEMPTS = 5;
  private static final int LOGIN_TOKEN_MIN_INTERVAL_SECONDS = 30;

  private String randomCode(int len) {
    String chars = "ABCDEFGHJKLMNPQRSTUVWXYZ23456789";
    StringBuilder sb = new StringBuilder(len);
    for (int i = 0; i < len; i++) sb.append(chars.charAt(RNG.nextInt(chars.length())));
    return sb.toString();
  }

  private String normalizeEmail(String raw) {
    return raw == null ? null : raw.trim().toLowerCase();
  }

  private boolean emailValido(String email) {
    return email != null && email.contains("@") && email.indexOf('@') > 0 && email.indexOf('@') < email.length()-3;
  }

  @PostMapping("/register-local")
  public ResponseEntity<?> registerLocal(@RequestBody RegisterRequest req) {
    String rawEmail = normalizeEmail(req.getEmail());
    if (!StringUtils.hasText(rawEmail) || !StringUtils.hasText(req.getPassword()) || !emailValido(rawEmail)) {
      return ResponseEntity.badRequest().body(Map.of("error", "email e senha válidos são obrigatórios"));
    }
    var email = rawEmail;
    if (users.findByEmail(email).isPresent()) {
      return ResponseEntity.status(409).body(Map.of("error","email já cadastrado"));
    }
    String local = email.substring(0, email.indexOf('@') > 0 ? email.indexOf('@') : email.length());
    String defaultName = Character.toUpperCase(local.charAt(0)) + local.substring(1);
    String verification = randomCode(6);
    User u = User.builder()
      .email(email)
      .name(defaultName) // novo
      .passwordHash(encoder.encode(req.getPassword()))
      .verified(false)
      .verificationToken(verification)
      .verificationTokenExpiresAt(Instant.now().plus(15, ChronoUnit.MINUTES))
      .build();
    users.save(u);
    emailService.sendVerificationEmail(u.getEmail(), verification);
    return ResponseEntity.ok(Map.of("message","Usuário criado. Verifique seu e-mail com o código enviado."));
  }

  @PostMapping("/verify-email")
  public ResponseEntity<?> verifyEmail(@RequestBody Map<String,String> body) {
    String email = body.get("email");
    String token = body.get("token");
    var uOpt = users.findByEmail(email == null ? "" : email.toLowerCase());
    if (uOpt.isEmpty()) return ResponseEntity.status(404).body(Map.of("error","usuário não encontrado"));
    var u = uOpt.get();
    if (u.isVerified()) return ResponseEntity.ok(Map.of("message","Conta já verificada."));
    if (u.getVerificationToken() == null
        || u.getVerificationTokenExpiresAt() == null
        || u.getVerificationTokenExpiresAt().isBefore(Instant.now())
        || !u.getVerificationToken().equalsIgnoreCase(token)) {
      return ResponseEntity.status(400).body(Map.of("error","token inválido ou expirado"));
    }
    u.setVerified(true);
    u.setVerificationToken(null);
    u.setVerificationTokenExpiresAt(null);
    users.save(u);
    return ResponseEntity.ok(Map.of("message","E-mail verificado. Você já pode solicitar token de login."));
  }

  @PostMapping("/resend-verification")
  public ResponseEntity<?> resendVerification(@RequestBody Map<String,String> body) {
    String email = normalizeEmail(body.get("email"));
    if (!emailValido(email)) return ResponseEntity.badRequest().body(Map.of("error","email inválido"));
    var uOpt = users.findByEmail(email);
    if (uOpt.isEmpty()) return ResponseEntity.status(404).body(Map.of("error","usuário não encontrado"));
    var u = uOpt.get();
    if (u.isVerified()) return ResponseEntity.ok(Map.of("message","Conta já verificada"));
    String verification = randomCode(6);
    u.setVerificationToken(verification);
    u.setVerificationTokenExpiresAt(Instant.now().plus(15, ChronoUnit.MINUTES));
    users.save(u);
    emailService.sendVerificationEmail(u.getEmail(), verification);
    return ResponseEntity.ok(Map.of("message","Novo código enviado"));
  }

  @PostMapping("/request-login-token")
  public ResponseEntity<?> requestLoginToken(@RequestBody LoginRequest req) {
    String email = normalizeEmail(req.getEmail());
    if (!StringUtils.hasText(email) || !StringUtils.hasText(req.getPassword())) {
      return ResponseEntity.badRequest().body(Map.of("error","email e senha são obrigatórios"));
    }
    var u = users.findByEmail(email).orElse(null);
    if (u == null || u.getPasswordHash() == null || !encoder.matches(req.getPassword(), u.getPasswordHash())) {
      return ResponseEntity.status(401).body(Map.of("error","credenciais inválidas"));
    }
    if (!u.isVerified()) {
      return ResponseEntity.status(403).body(Map.of("error","conta não verificada"));
    }

    Instant now = Instant.now();
    // Bloqueia spam (tempo mínimo entre envios)
    if (u.getLastLoginTokenSentAt() != null &&
        u.getLastLoginTokenSentAt().isAfter(now.minusSeconds(LOGIN_TOKEN_MIN_INTERVAL_SECONDS))) {
      long wait = LOGIN_TOKEN_MIN_INTERVAL_SECONDS - ChronoUnit.SECONDS.between(u.getLastLoginTokenSentAt(), now);
      return ResponseEntity.status(429).body(Map.of("error","aguarde para pedir novo token","retryAfterSeconds", wait));
    }

    // Gerar novo token se:
    // - não existe
    // - expirado
    // - attempts >= max
    boolean precisaNovo = false;
    if (u.getLoginToken() == null || u.getLoginTokenExpiresAt() == null) precisaNovo = true;
    else if (u.getLoginTokenExpiresAt().isBefore(now)) precisaNovo = true;
    else if (u.getLoginTokenAttempts() != null && u.getLoginTokenAttempts() >= LOGIN_TOKEN_MAX_ATTEMPTS) precisaNovo = true;

    if (precisaNovo) {
      u.setLoginToken(randomCode(6));
      u.setLoginTokenExpiresAt(now.plus(10, ChronoUnit.MINUTES));
      u.setLoginTokenAttempts(0);
    }

    u.setLastLoginTokenSentAt(now);
    users.save(u);
    emailService.sendLoginTokenEmail(u.getEmail(), u.getLoginToken());

    return ResponseEntity.ok(Map.of(
      "message","Token de login enviado",
      "expiresAt", u.getLoginTokenExpiresAt().toString()
    ));
  }

  @PostMapping("/verify-login-token")
  public ResponseEntity<?> verifyLoginToken(@RequestBody LoginRequest req) {
    String email = normalizeEmail(req.getEmail());
    if (!StringUtils.hasText(email) || !StringUtils.hasText(req.getPassword()) || !StringUtils.hasText(req.getToken())) {
      return ResponseEntity.badRequest().body(Map.of("error","email, senha e token são obrigatórios"));
    }
    var u = users.findByEmail(email).orElse(null);
    if (u == null || u.getPasswordHash() == null || !encoder.matches(req.getPassword(), u.getPasswordHash())) {
      return ResponseEntity.status(401).body(Map.of("error","credenciais inválidas"));
    }
    if (!u.isVerified()) {
      return ResponseEntity.status(403).body(Map.of("error","conta não verificada"));
    }
    Instant now = Instant.now();
    if (u.getLoginToken() == null || u.getLoginTokenExpiresAt() == null || u.getLoginTokenExpiresAt().isBefore(now)) {
      return ResponseEntity.status(401).body(Map.of("error","token expirado ou inexistente"));
    }
    // Incrementa tentativas antes de validar
    u.setLoginTokenAttempts((u.getLoginTokenAttempts() == null ? 0 : u.getLoginTokenAttempts()) + 1);
    if (!u.getLoginToken().equalsIgnoreCase(req.getToken())) {
      users.save(u);
      if (u.getLoginTokenAttempts() >= LOGIN_TOKEN_MAX_ATTEMPTS) {
        // força regeneração no próximo request-login-token
        return ResponseEntity.status(401).body(Map.of("error","token inválido - máximo de tentativas atingido, solicite novo"));
      }
      return ResponseEntity.status(401).body(Map.of("error","token inválido"));
    }
    // Sucesso → limpa estado
    u.setLoginToken(null);
    u.setLoginTokenExpiresAt(null);
    u.setLoginTokenAttempts(0);
    users.save(u);
    tokenService.revokeUserSessionTokens(u);
    var pair = tokenService.issueLoginTokens(u, req.isRememberMe());
    return ResponseEntity.ok(pair);
  }

  @PostMapping("/login-local")
  public ResponseEntity<?> loginLocal(@RequestBody LoginRequest req) {
    // Mantido para retrocompatibilidade: delega para verify-login-token
    return verifyLoginToken(req);
  }

  @PostMapping("/refresh")
  public ResponseEntity<?> refresh(@RequestBody Map<String,String> body) {
    String refresh = body.get("refreshToken");
    if (refresh == null || refresh.isBlank())
      return ResponseEntity.status(HttpStatus.UNAUTHORIZED).body(Map.of("error","refreshToken ausente"));
    String newAccess = tokenService.rotateAccess(refresh);
    if (newAccess == null)
      return ResponseEntity.status(HttpStatus.UNAUTHORIZED).body(Map.of("error","refreshToken inválido/expirado"));
    return ResponseEntity.ok(Map.of("accessToken", newAccess));
  }

  @PostMapping("/logout")
  public ResponseEntity<?> logout(@RequestBody Map<String,String> body) {
    String refresh = body.get("refreshToken");
    if (refresh != null) tokenService.revokeRefresh(refresh);
    return ResponseEntity.ok(Map.of("message","logout efetuado"));
  }

  @Data
  public static class RegisterRequest {
    private String email;
    private String password;
  }

  @Data
  public static class LoginRequest {
    private String email;
    private String password;
    private String token;
    private boolean rememberMe;
  }
}
