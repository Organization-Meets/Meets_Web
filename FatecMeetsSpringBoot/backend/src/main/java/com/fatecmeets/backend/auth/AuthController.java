package com.fatecmeets.backend.auth;

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
    public String login(@RequestParam String email, @RequestParam String senha) {
        authService.iniciarLogin(email, senha);
        return "Verifique seu e-mail para confirmar o login.";
    }

    // 🔹 Confirmação de login por token (link enviado no email)
    @GetMapping("/confirm-login")
    public String confirmLogin(@RequestParam String token) {
        return authService.confirmarLogin(token) ? "Login confirmado!" : "Token inválido ou expirado.";
    }

    // 🔹 Registro local separado de OAuth
    @PostMapping("/register-local")
    public String registerLocal(@RequestParam String email, @RequestParam String senha) {
        authService.registrarUsuario(email, senha);
        return "Verifique seu e-mail para ativar a conta.";
    }

    // 🔹 Ativação de conta local
    @GetMapping("/activate")
    public String activate(@RequestParam String token) {
        return authService.ativarConta(token) ? "Conta ativada com sucesso!" : "Token inválido ou expirado.";
    }
}
