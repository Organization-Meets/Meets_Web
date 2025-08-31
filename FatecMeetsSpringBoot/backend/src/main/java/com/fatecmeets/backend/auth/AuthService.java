package com.fatecmeets.backend.auth;

import com.fatecmeets.backend.usuario.Usuario;
import com.fatecmeets.backend.usuario.UsuarioRepository;
import com.fatecmeets.backend.usuario.UsuarioService;
import com.fatecmeets.backend.token.TokenService;
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

    // Cadastro já gera token + envia e-mail pelo UsuarioService
    public Usuario registrarUsuario(String email, String senha) {
        return usuarioService.cadastrar(email, senha);
    }

    public boolean ativarConta(String token) {
        return tokenService.validarTokenAtivacao(token);
    }

    public String iniciarLogin(String email, String senha) {
        Usuario usuario = usuarioRepo.findByEmail(email)
                .orElseThrow(() -> new RuntimeException("Usuário não encontrado"));
        
        if (!usuario.isAtivo()) {
            throw new RuntimeException("Conta ainda não ativada.");
        }

        if (!passwordEncoder.matches(senha, usuario.getSenha())) {
            throw new RuntimeException("Senha incorreta.");
        }

        String token = tokenService.gerarTokenLogin(usuario);
        emailService.enviarToken(email, token, "LOGIN");
        return token;
    }

    public boolean confirmarLogin(String token) {
        return tokenService.validarTokenLogin(token);
    }
}
