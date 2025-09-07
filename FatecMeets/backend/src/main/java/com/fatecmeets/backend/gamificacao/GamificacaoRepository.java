package com.fatecmeets.backend.gamificacao;

import org.springframework.data.jpa.repository.JpaRepository;

public interface GamificacaoRepository extends JpaRepository<Gamificacao, Long> {
    boolean existsByNickname(String nickname);
    Optional<Gamificacao> findByNickname(String nickname);
}
