package com.fatecmeets.backend.auth;

import org.springframework.web.bind.annotation.*;

@RestController
@RequestMapping("/auth")
public class AuthController {
    private final AuthService authService;

    public AuthController(AuthService authService) {
        this.authService = authService;
    }

    @PostMapping("/login")
    public String login(@RequestParam String email, @RequestParam String senha) {
        authService.iniciarLogin(email, senha);
        return "Verifique seu e-mail para confirmar o login.";
    }

    @GetMapping("/confirm-login")
    public String confirmLogin(@RequestParam String token) {
        return authService.confirmarLogin(token) ? "Login confirmado!" : "Token inválido ou expirado.";
    }

    @PostMapping("/register")
    public String register(@RequestParam String email, @RequestParam String senha) {
        authService.registrarUsuario(email, senha);
        return "Verifique seu e-mail para ativar a conta.";
    }

    @GetMapping("/activate")
    public String activate(@RequestParam String token) {
        return authService.ativarConta(token) ? "Conta ativada com sucesso!" : "Token inválido ou expirado.";
    }
}
