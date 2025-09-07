package com.fatecmeets.backend.administrador;

import org.springframework.data.jpa.repository.JpaRepository;

public interface AdministradorRepository extends JpaRepository<Administrador, Long> {
    boolean existsByUsuarioId(Long usuarioId);
}
