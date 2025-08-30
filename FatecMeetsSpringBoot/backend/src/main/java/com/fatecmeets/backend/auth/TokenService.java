package com.fatecmeets.backend.auth;

import com.fatecmeets.backend.usuario.Usuario;
import org.springframework.stereotype.Service;

import java.time.LocalDateTime;
import java.util.*;

@Service
public class TokenService {
    private final Map<String, TokenInfo> tokens = new HashMap<>();

    public String gerarTokenAtivacao(Usuario usuario) {
        String token = UUID.randomUUID().toString();
        tokens.put(token, new TokenInfo(usuario, LocalDateTime.now().plusHours(24), "ATIVACAO"));
        return token;
    }

    public String gerarTokenLogin(Usuario usuario) {
        String token = UUID.randomUUID().toString();
        tokens.put(token, new TokenInfo(usuario, LocalDateTime.now().plusMinutes(10), "LOGIN"));
        return token;
    }

    public boolean validarTokenAtivacao(String token) {
        return validarToken(token, "ATIVACAO");
    }

    public boolean validarTokenLogin(String token) {
        return validarToken(token, "LOGIN");
    }

    private boolean validarToken(String token, String tipo) {
        TokenInfo info = tokens.get(token);
        if (info != null && info.tipo.equals(tipo) && info.expiraEm.isAfter(LocalDateTime.now())) {
            tokens.remove(token);
            return true;
        }
        return false;
    }

    private record TokenInfo(Usuario usuario, LocalDateTime expiraEm, String tipo) {}
}
