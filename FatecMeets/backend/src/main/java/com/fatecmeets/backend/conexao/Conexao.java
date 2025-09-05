package com.fatecmeets.backend.conexao;

import com.fatecmeets.backend.common.Auditable;
import com.fatecmeets.backend.usuario.Usuario;
import jakarta.persistence.*;
import lombok.*;

@Entity
@Table(name = "conexoes",
        uniqueConstraints = @UniqueConstraint(name = "uq_conexao", columnNames = {"usuario_origem_id","usuario_destino_id"}))
@Getter @Setter @NoArgsConstructor @AllArgsConstructor @Builder
public class Conexao extends Auditable {
    @Id @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    @ManyToOne(optional = false) @JoinColumn(name = "usuario_origem_id")
    private Usuario usuarioOrigem;

    @ManyToOne(optional = false) @JoinColumn(name = "usuario_destino_id")
    private Usuario usuarioDestino;

    @Enumerated(EnumType.STRING)
    private ConexaoStatus status = ConexaoStatus.pendente;
}
