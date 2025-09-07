package com.fatecmeets.backend.token;

import lombok.RequiredArgsConstructor;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.stereotype.Service;

import java.security.SecureRandom;
import java.time.Instant;
import java.time.temporal.ChronoUnit;
import java.util.HexFormat;
import java.util.Map;

@Service
@RequiredArgsConstructor
public class TokenService {
    private static final Logger log = LoggerFactory.getLogger(TokenService.class);
    private final TokenRepository repo;
    private static final SecureRandom RNG = new SecureRandom();
    private static final HexFormat HEX = HexFormat.of();

    private String randomToken(int bytes) {
        byte[] b = new byte[bytes];
        RNG.nextBytes(b);
        return HEX.formatHex(b).toUpperCase();
    }

    public Map<String,String> issueLoginTokens(Long usuarioId, boolean longLived) {
        // access ~15m
        Token access = Token.builder()
                .token(randomToken(16))
                .type(TokenType.ACCESS)
                .expiresAt(Instant.now().plus(15, ChronoUnit.MINUTES))
                .userId(usuarioId)
                .build();
        // refresh ~7d ou 30d
        int days = longLived ? 30 : 7;
        Token refresh = Token.builder()
                .token(randomToken(32))
                .type(TokenType.REFRESH)
                .expiresAt(Instant.now().plus(days, ChronoUnit.DAYS))
                .userId(usuarioId)
                .build();
        repo.save(access);
        repo.save(refresh);
        log.debug("Tokens emitidos para user {}", usuarioId);
        return Map.of("accessToken", access.getToken(), "refreshToken", refresh.getToken());
    }

    public void revokeUserSessionTokens(Long usuarioId) {
        repo.findByUserIdAndType(usuarioId, TokenType.ACCESS).forEach(t -> t.setRevoked(true));
        repo.findByUserIdAndType(usuarioId, TokenType.REFRESH).forEach(t -> t.setRevoked(true));
    }

    public String rotateAccess(String refreshToken) {
        var opt = repo.findByTokenAndTypeAndRevokedFalse(refreshToken, TokenType.REFRESH);
        if (opt.isEmpty()) return null;
        var r = opt.get();
        if (r.getExpiresAt().isBefore(Instant.now())) {
            r.setRevoked(true);
            repo.save(r);
            return null;
        }
        // gera novo access
        Token access = Token.builder()
                .token(randomToken(16))
                .type(TokenType.ACCESS)
                .expiresAt(Instant.now().plus(15, ChronoUnit.MINUTES))
                .userId(r.getUserId())
                .build();
        repo.save(access);
        return access.getToken();
    }

    public void revokeRefresh(String refreshToken) {
        repo.findByTokenAndTypeAndRevokedFalse(refreshToken, TokenType.REFRESH)
                .ifPresent(t -> { t.setRevoked(true); repo.save(t); });
    }
}
