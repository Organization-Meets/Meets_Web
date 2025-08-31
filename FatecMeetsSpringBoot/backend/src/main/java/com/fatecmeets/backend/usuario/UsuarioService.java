package com.fatecmeets.backend.usuario;

import com.fatecmeets.backend.auth.EmailService;
import com.fatecmeets.backend.token.TokenService;
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

    public Usuario cadastrar(String email, String senha) {
        Usuario u = new Usuario();
        u.setEmail(email);
        u.setSenha(passwordEncoder.encode(senha));
        u.setAtivo(false);
        Usuario usuarioSalvo = usuarioRepo.save(u);
        String token = tokenService.gerarTokenAtivacao(usuarioSalvo);
        emailService.enviarToken(email, token, "ATIVACAO");
        return usuarioSalvo;
    }
}
