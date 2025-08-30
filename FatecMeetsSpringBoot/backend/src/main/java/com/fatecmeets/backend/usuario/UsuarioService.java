package com.fatecmeets.backend.usuario;

import com.fatecmeets.backend.auth.EmailService;
import com.fatecmeets.backend.auth.TokenService;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.stereotype.Service;

@Service
public class UsuarioService {
    private final UsuarioRepository usuarioRepo;
    private final PasswordEncoder passwordEncoder;
    private final TokenService tokenService;
    private final EmailService emailService;

    public UsuarioService(UsuarioRepository usuarioRepo, PasswordEncoder passwordEncoder,
                          TokenService tokenService, EmailService emailService) {
        this.usuarioRepo = usuarioRepo;
        this.passwordEncoder = passwordEncoder;
        this.tokenService = tokenService;
        this.emailService = emailService;
    }

    public void cadastrar(String email, String senha) {
        Usuario u = new Usuario();
        u.setEmail(email);
        u.setSenha(passwordEncoder.encode(senha));
        u.setAtivo(false);
        usuarioRepo.save(u);

        String token = tokenService.gerarTokenAtivacao(u);
        emailService.enviarToken(email, token, "ATIVACAO");
    }
}
