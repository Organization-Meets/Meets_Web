package com.fatecmeets.backend.auth;

import com.fatecmeets.backend.usuario.Usuario;
import com.fatecmeets.backend.usuario.UsuarioRepository;
import com.fatecmeets.backend.usuario.UsuarioService;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.stereotype.Service;

@Service
public class AuthService {
    private final UsuarioRepository usuarioRepo;
    private final UsuarioService usuarioService;
    private final PasswordEncoder passwordEncoder;
    private final TokenService tokenService;
    private final EmailService emailService;

    public AuthService(UsuarioRepository usuarioRepo, UsuarioService usuarioService,
                       PasswordEncoder passwordEncoder, TokenService tokenService,
                       EmailService emailService) {
        this.usuarioRepo = usuarioRepo;
        this.usuarioService = usuarioService;
        this.passwordEncoder = passwordEncoder;
        this.tokenService = tokenService;
        this.emailService = emailService;
    }

    public void registrarUsuario(String email, String senha) {
        usuarioService.cadastrar(email, senha);
    }

    public boolean ativarConta(String token) {
        return tokenService.validarTokenAtivacao(token);
    }

    public void iniciarLogin(String email, String senha) {
        Usuario usuario = usuarioRepo.findByEmail(email).orElseThrow();
        if (!usuario.isAtivo() || !passwordEncoder.matches(senha, usuario.getSenha())) {
            throw new RuntimeException("Credenciais inválidas.");
        }
        String token = tokenService.gerarTokenLogin(usuario);
        emailService.enviarToken(email, token, "LOGIN");
    }

    public boolean confirmarLogin(String token) {
        return tokenService.validarTokenLogin(token);
    }
}
