package com.fatecmeets.backend.gamificacao;

import org.springframework.data.jpa.repository.JpaRepository;

import java.util.Optional;

public interface GamificacaoRepository extends JpaRepository<Gamificacao, Long> {
    Optional<Gamificacao> findByNickname(String nickname);
}
