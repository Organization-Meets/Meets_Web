package com.fatecmeets.backend.conexao;

import com.fatecmeets.backend.usuario.Usuario;
import org.springframework.data.jpa.repository.JpaRepository;

import java.util.Optional;

public interface ConexaoRepository extends JpaRepository<Conexao, Long> {
    Optional<Conexao> findByUsuarioOrigemAndUsuarioDestino(Usuario o, Usuario d);
}
