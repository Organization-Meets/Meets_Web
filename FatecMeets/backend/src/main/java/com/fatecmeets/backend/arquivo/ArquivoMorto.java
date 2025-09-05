package com.fatecmeets.backend.arquivo;

import com.fatecmeets.backend.common.Auditable;
import com.fatecmeets.backend.usuario.Usuario;
import jakarta.persistence.*;
import lombok.*;

@Entity
@Table(name = "arquivos_mortos")
@Getter @Setter @NoArgsConstructor @AllArgsConstructor @Builder
public class ArquivoMorto extends Auditable {
    @Id @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    @ManyToOne(optional = false) @JoinColumn(name = "usuario_id")
    private Usuario usuario;

    @Column(name = "tabela_origem", length = 100, nullable = false)
    private String tabelaOrigem;

    @Column(name = "registro_origem_id", nullable = false)
    private Long registroOrigemId;

    @Column(columnDefinition = "TEXT")
    private String motivoExclusao;

    @Column(columnDefinition = "JSON")
    private String dados;
}
