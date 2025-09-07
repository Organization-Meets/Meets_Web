package com.fatecmeets.backend.auth;

import com.fatecmeets.backend.email.EmailService;
import com.fatecmeets.backend.token.TokenService;
import com.fatecmeets.backend.usuario.Usuario;
import com.fatecmeets.backend.usuario.UsuarioRepository;
import com.fatecmeets.backend.usuario.UsuarioStatus;
import com.fatecmeets.backend.gamificacao.Gamificacao;
import com.fatecmeets.backend.gamificacao.GamificacaoRepository;
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

@RestController
@RequestMapping("/api/auth")
@RequiredArgsConstructor
public class AuthController {

  private final UsuarioRepository usuarios;
  private final GamificacaoRepository gamificacoes;
  private final PasswordEncoder encoder;
  private final EmailService emailService;
  private final TokenService tokenService;

  private static final SecureRandom RNG = new SecureRandom();

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
    if (usuarios.existsByEmail(rawEmail)) {
      return ResponseEntity.status(409).body(Map.of("error","email já cadastrado"));
    }
    String local = rawEmail.substring(0, rawEmail.indexOf('@') > 0 ? rawEmail.indexOf('@') : rawEmail.length());
    String defaultName = Character.toUpperCase(local.charAt(0)) + local.substring(1);
    String verification = randomCode(6);

    Usuario u = Usuario.builder()
      .email(rawEmail)
      .password(encoder.encode(req.getPassword()))
      .status(UsuarioStatus.inativo)           // aguardando verificação
      .emailVerificationToken(verification)
      .build();
    usuarios.save(u);

    // Gamificação automática
    String baseNick = local.replaceAll("[^a-zA-Z0-9]","").toLowerCase();
    String nick = baseNick;
    int c = 1;
    while (gamificacoes.existsByNickname(nick)) {
      nick = baseNick + c++;
    }
    gamificacoes.save(Gamificacao.builder()
        .usuario(u)
        .nickname(nick)
        .build());

    emailService.sendVerificationEmail(u.getEmail(), verification);
    return ResponseEntity.ok(Map.of("message","Usuário criado. Verifique seu e-mail com o código enviado."));
  }

  @PostMapping("/verify-email")
  public ResponseEntity<?> verifyEmail(@RequestBody Map<String,String> body) {
    String email = normalizeEmail(body.get("email"));
    String token = body.get("token");
    var opt = usuarios.findByEmail(email == null ? "" : email);
    if (opt.isEmpty()) return ResponseEntity.status(404).body(Map.of("error","usuário não encontrado"));
    var u = opt.get();
    if (u.isVerified()) return ResponseEntity.ok(Map.of("message","Conta já verificada."));
    if (u.getEmailVerificationToken() == null || !u.getEmailVerificationToken().equalsIgnoreCase(token)) {
      return ResponseEntity.status(400).body(Map.of("error","token inválido"));
    }
    u.setStatus(UsuarioStatus.ativo);
    u.setEmailVerificationToken(null);
    u.setEmailVerifiedAt(Instant.now());
    usuarios.save(u);
    return ResponseEntity.ok(Map.of("message","E-mail verificado. Você já pode solicitar token de login."));
  }

  @PostMapping("/resend-verification")
  public ResponseEntity<?> resendVerification(@RequestBody Map<String,String> body) {
    String email = normalizeEmail(body.get("email"));
    if (!emailValido(email)) return ResponseEntity.badRequest().body(Map.of("error","email inválido"));
    var opt = usuarios.findByEmail(email);
    if (opt.isEmpty()) return ResponseEntity.status(404).body(Map.of("error","usuário não encontrado"));
    var u = opt.get();
    if (u.isVerified()) return ResponseEntity.ok(Map.of("message","Conta já verificada"));
    String verification = randomCode(6);
    u.setEmailVerificationToken(verification);
    usuarios.save(u);
    emailService.sendVerificationEmail(u.getEmail(), verification);
    return ResponseEntity.ok(Map.of("message","Novo código enviado"));
  }

  @PostMapping("/request-login-token")
  public ResponseEntity<?> requestLoginToken(@RequestBody LoginRequest req) {
    String email = normalizeEmail(req.getEmail());
    if (!StringUtils.hasText(email) || !StringUtils.hasText(req.getPassword())) {
      return ResponseEntity.badRequest().body(Map.of("error","email e senha são obrigatórios"));
    }
    var u = usuarios.findByEmail(email).orElse(null);
    if (u == null || u.getPassword() == null || !encoder.matches(req.getPassword(), u.getPassword())) {
      return ResponseEntity.status(401).body(Map.of("error","credenciais inválidas"));
    }
    if (!u.isVerified()) return ResponseEntity.status(403).body(Map.of("error","conta não verificada"));
    Instant now = Instant.now();
    if (u.getLastLoginTokenSentAt() != null &&
        u.getLastLoginTokenSentAt().isAfter(now.minusSeconds(LOGIN_TOKEN_MIN_INTERVAL_SECONDS))) {
      long wait = LOGIN_TOKEN_MIN_INTERVAL_SECONDS - ChronoUnit.SECONDS.between(u.getLastLoginTokenSentAt(), now);
      return ResponseEntity.status(429).body(Map.of("error","aguarde para pedir novo token","retryAfterSeconds", wait));
    }
    boolean novo = u.getLoginToken() == null ||
                   u.getLoginTokenExpiresAt() == null ||
                   u.getLoginTokenExpiresAt().isBefore(now) ||
                   (u.getLoginTokenAttempts() != null && u.getLoginTokenAttempts() >= LOGIN_TOKEN_MAX_ATTEMPTS);

    if (novo) {
      u.setLoginToken(randomCode(6));
      u.setLoginTokenExpiresAt(now.plus(10, ChronoUnit.MINUTES));
      u.setLoginTokenAttempts(0);
    }
    u.setLastLoginTokenSentAt(now);
    usuarios.save(u);
    emailService.sendLoginTokenEmail(u.getEmail(), u.getLoginToken());
    return ResponseEntity.ok(Map.of("message","Token de login enviado","expiresAt", u.getLoginTokenExpiresAt().toString()));
  }

  @PostMapping("/verify-login-token")
  public ResponseEntity<?> verifyLoginToken(@RequestBody LoginRequest req) {
    String email = normalizeEmail(req.getEmail());
    if (!StringUtils.hasText(email) || !StringUtils.hasText(req.getPassword()) || !StringUtils.hasText(req.getToken())) {
      return ResponseEntity.badRequest().body(Map.of("error","email, senha e token são obrigatórios"));
    }
    var u = usuarios.findByEmail(email).orElse(null);
    if (u == null || u.getPassword() == null || !encoder.matches(req.getPassword(), u.getPassword())) {
      return ResponseEntity.status(401).body(Map.of("error","credenciais inválidas"));
    }
    if (!u.isVerified()) return ResponseEntity.status(403).body(Map.of("error","conta não verificada"));
    Instant now = Instant.now();
    if (u.getLoginToken() == null || u.getLoginTokenExpiresAt() == null || u.getLoginTokenExpiresAt().isBefore(now)) {
      return ResponseEntity.status(401).body(Map.of("error","token expirado ou inexistente"));
    }
    u.setLoginTokenAttempts((u.getLoginTokenAttempts() == null ? 0 : u.getLoginTokenAttempts()) + 1);
    if (!u.getLoginToken().equalsIgnoreCase(req.getToken())) {
      usuarios.save(u);
      if (u.getLoginTokenAttempts() >= LOGIN_TOKEN_MAX_ATTEMPTS) {
        return ResponseEntity.status(401).body(Map.of("error","token inválido - máximo atingido"));
      }
      return ResponseEntity.status(401).body(Map.of("error","token inválido"));
    }
    u.setLoginToken(null);
    u.setLoginTokenExpiresAt(null);
    u.setLoginTokenAttempts(0);
    usuarios.save(u);
    // tokenService agora deve aceitar Usuario; ajustar implementação correspondente
    tokenService.revokeUserSessionTokens(u.getId());
    var pair = tokenService.issueLoginTokens(u.getId(), req.isRememberMe());
    return ResponseEntity.ok(pair);
  }

  @PostMapping("/login-local")
  public ResponseEntity<?> loginLocal(@RequestBody LoginRequest req) {
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
