package com.fatecmeets.backend.auth;

import com.fatecmeets.backend.email.EmailService;
import com.fatecmeets.backend.user.User;
import com.fatecmeets.backend.user.UserRepository;
import lombok.Data;
import lombok.RequiredArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.util.StringUtils;
import org.springframework.web.bind.annotation.*;

import java.time.Instant;
import java.time.temporal.ChronoUnit;
import java.util.Map;
import java.util.UUID;

@RestController
@RequestMapping("/api/auth")
@RequiredArgsConstructor
public class AuthController {

  private final UserRepository users;
  private final PasswordEncoder encoder;
  private final EmailService emailService;

  @PostMapping("/register-local")
  public ResponseEntity<?> registerLocal(@RequestBody RegisterRequest req) {
    if (!StringUtils.hasText(req.getEmail()) || !StringUtils.hasText(req.getPassword())) {
      return ResponseEntity.badRequest().body(Map.of("error", "email e senha são obrigatórios"));
    }
    if (users.findByEmail(req.getEmail()).isPresent()) {
      return ResponseEntity.status(409).body(Map.of("error", "email já cadastrado"));
    }
    String token = UUID.randomUUID().toString().substring(0, 6).toUpperCase();
    User u = User.builder()
      .email(req.getEmail().toLowerCase())
      .passwordHash(encoder.encode(req.getPassword()))
      .verified(false)
      .loginToken(token)
      .loginTokenExpiresAt(Instant.now().plus(15, ChronoUnit.MINUTES))
      .build();
    users.save(u);
    emailService.sendTokenEmail(u.getEmail(), token);
    return ResponseEntity.ok(Map.of("message", "Usuário criado. Token enviado por e-mail."));
  }

  @PostMapping("/login-local")
  public ResponseEntity<?> loginLocal(@RequestBody LoginRequest req) {
    var u = users.findByEmail(req.getEmail().toLowerCase()).orElse(null);
    if (u == null || !encoder.matches(req.getPassword(), u.getPasswordHash())) {
      return ResponseEntity.status(401).body(Map.of("error", "credenciais inválidas"));
    }
    if (u.getLoginToken() == null || u.getLoginTokenExpiresAt() == null
      || u.getLoginTokenExpiresAt().isBefore(Instant.now())
      || !u.getLoginToken().equalsIgnoreCase(req.getToken())) {
      return ResponseEntity.status(401).body(Map.of("error", "token inválido ou expirado"));
    }
    u.setVerified(true);
    // limpar token após uso
    u.setLoginToken(null);
    u.setLoginTokenExpiresAt(null);
    users.save(u);

    // TODO: emitir JWT/refresh conforme necessidade
    return ResponseEntity.ok(Map.of(
      "accessToken", "dummy-access-token",
      "refreshToken", req.isRememberMe() ? "dummy-refresh-token" : ""
    ));
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
