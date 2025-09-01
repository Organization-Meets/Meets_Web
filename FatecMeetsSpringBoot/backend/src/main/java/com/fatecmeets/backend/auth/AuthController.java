package com.fatecmeets.backend.auth;

import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

@RestController
@RequestMapping("/auth")
public class AuthController {
    private final AuthService authService;

    public AuthController(AuthService authService) {
        this.authService = authService;
    }

    // 🔹 Login local (via email + senha)
    @PostMapping("/login")
    public ResponseEntity<?> login(@RequestBody AuthRequest request) {
        try {
            authService.iniciarLogin(request.email(), request.senha());
            return ResponseEntity.ok("Verifique seu e-mail para confirmar o login.");
        } catch (RuntimeException e) {
            return ResponseEntity.badRequest().body(e.getMessage());
        }
    }

    // 🔹 Registro local
    @PostMapping("/register")
    public ResponseEntity<?> register(@RequestBody AuthRequest request) {
        try {
            authService.registrarUsuario(request.email(), request.senha());
            return ResponseEntity.ok("Verifique seu e-mail para ativar a conta.");
        } catch (RuntimeException e) {
            return ResponseEntity.badRequest().body(e.getMessage());
        }
    }

    // 🔹 Confirmação de login
    @GetMapping("/confirm-login")
    public ResponseEntity<String> confirmLogin(@RequestParam String token) {
        boolean ok = authService.confirmarLogin(token);
        if (ok) {
            return ResponseEntity.ok("Login confirmado!");
        } else {
            return ResponseEntity.badRequest().body("Token inválido ou expirado.");
        }
    }

    // 🔹 Ativação de conta local
    @GetMapping("/activate")
    public ResponseEntity<String> activate(@RequestParam String token) {
        boolean ok = authService.ativarConta(token);
        if (ok) {
            return ResponseEntity.ok("Conta ativada com sucesso!");
        } else {
            return ResponseEntity.badRequest().body("Token inválido ou expirado.");
        }
    }
}
