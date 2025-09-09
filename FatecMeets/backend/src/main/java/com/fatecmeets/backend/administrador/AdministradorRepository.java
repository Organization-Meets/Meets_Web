package com.fatecmeets.backend.administrador;

import org.springframework.data.jpa.repository.JpaRepository;
import java.util.Optional;

public interface AdministradorRepository extends JpaRepository<Administrador, Long> {
    boolean existsByUsuarioId(Long usuarioId);
    Optional<Administrador> findFirstByUsuarioId(Long usuarioId);
}
