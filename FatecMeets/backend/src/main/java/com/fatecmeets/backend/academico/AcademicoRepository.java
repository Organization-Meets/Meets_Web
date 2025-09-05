package com.fatecmeets.backend.academico;

import org.springframework.data.jpa.repository.JpaRepository;

import java.util.Optional;

public interface AcademicoRepository extends JpaRepository<Academico, Long> {
    Optional<Academico> findByRa(String ra);
}
