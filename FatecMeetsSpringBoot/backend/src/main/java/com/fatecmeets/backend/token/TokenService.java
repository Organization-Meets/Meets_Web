package com.fatecmeets.backend.token;

import com.fatecmeets.backend.usuario.Usuario;
import org.springframework.stereotype.Service;

import java.time.LocalDateTime;
import java.util.Optional;
import java.util.UUID;

@Service
public class TokenService {
    private final TokenRepository tokenRepository;

    public TokenService(TokenRepository tokenRepository) {
        this.tokenRepository = tokenRepository;
    }

    public String gerarTokenAtivacao(Usuario usuario) {
        return salvarToken(usuario, "ATIVACAO", LocalDateTime.now().plusHours(24));
    }

    public String gerarTokenLogin(Usuario usuario) {
        return salvarToken(usuario, "LOGIN", LocalDateTime.now().plusMinutes(10));
    }

    private String salvarToken(Usuario usuario, String tipo, LocalDateTime expiraEm) {
        String token = UUID.randomUUID().toString();
        Token tv = new Token();
        tv.setToken(token);
        tv.setUsuario(usuario);
        tv.setExpiraEm(expiraEm);
        tv.setTipo(tipo);
        tokenRepository.save(tv);
        return token;
    }

    public boolean validarTokenAtivacao(String token) {
        return validarToken(token, "ATIVACAO");
    }

    public boolean validarTokenLogin(String token) {
        return validarToken(token, "LOGIN");
    }

    private boolean validarToken(String token, String tipo) {
        Optional<Token> opt = tokenRepository.findByToken(token);
        if (opt.isPresent()) {
            Token tv = opt.get();
            if (tv.getTipo().equals(tipo) && tv.getExpiraEm().isAfter(LocalDateTime.now())) {
                tokenRepository.deleteByToken(token); // Invalida após uso
                return true;
            }
        }
        return false;
    }

    public Optional<Usuario> getUsuarioPorToken(String token) {
        return tokenRepository.findByToken(token)
                .filter(tv -> tv.getExpiraEm().isAfter(LocalDateTime.now()))
                .map(Token::getUsuario);
    }
}
