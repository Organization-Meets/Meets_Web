package com.fatecmeets.backend.instituicao;

import com.fatecmeets.backend.administrador.Administrador;
import com.fatecmeets.backend.common.Auditable;
import com.fatecmeets.backend.endereco.Endereco;
import com.fatecmeets.backend.telefone.Telefone;
import jakarta.persistence.*;
import lombok.*;

@Entity
@Table(name = "instituicoes", indexes = {
        @Index(name = "uk_instituicoes_codigo", columnList = "codigo", unique = true)
})
@Getter @Setter @NoArgsConstructor @AllArgsConstructor @Builder
public class Instituicao extends Auditable {
    @Id @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    @Column(length = 20, unique = true, nullable = false)
    private String codigo;

    @Column(length = 150, nullable = false)
    private String nome;

    @ManyToOne(optional = false) @JoinColumn(name = "administrador_id")
    private Administrador administrador;

    @ManyToOne(optional = false) @JoinColumn(name = "endereco_id")
    private Endereco endereco;

    @ManyToOne(optional = false) @JoinColumn(name = "telefone_id")
    private Telefone telefone;
}
