package com.fatecmeets.backend.token;

import org.springframework.data.jpa.repository.JpaRepository;
import java.util.List;
import java.util.Optional;

public interface TokenRepository extends JpaRepository<Token, Long> {
  Optional<Token> findByTokenAndTypeAndRevokedFalse(String token, TokenType type);
  List<Token> findByUsuarioIdAndType(Long usuarioId, TokenType type);
}
