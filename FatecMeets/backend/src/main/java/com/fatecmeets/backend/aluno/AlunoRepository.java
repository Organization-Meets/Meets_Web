package com.fatecmeets.backend.aluno;

import org.springframework.data.jpa.repository.JpaRepository;

import java.util.Optional;

public interface AlunoRepository extends JpaRepository<Aluno, Long> {
    Optional<Aluno> findByRa(String ra);
    boolean existsByUsuarioId(Long usuarioId);
}
