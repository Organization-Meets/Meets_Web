package com.fatecmeets.backend.complemento;

import com.fatecmeets.backend.common.Auditable;
import com.fatecmeets.backend.endereco.Endereco;
import jakarta.persistence.*;
import lombok.*;

@Entity
@Table(name = "complementos")
@Getter @Setter @NoArgsConstructor @AllArgsConstructor @Builder
public class Complemento extends Auditable {
    @Id @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    @ManyToOne(optional = false) @JoinColumn(name = "endereco_id")
    private Endereco endereco;

    private String nome;
}
