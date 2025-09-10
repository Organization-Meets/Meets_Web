package com.fatecmeets.backend.telefone;

import com.fatecmeets.backend.common.Auditable;
import jakarta.persistence.*;
import lombok.*;

@Entity
@Table(name = "telefones", indexes = {
        @Index(name = "idx_telefones_tipo", columnList = "tipo")
})
@Getter @Setter @NoArgsConstructor @AllArgsConstructor @Builder
public class Telefone extends Auditable {
    @Id @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    @Column(length = 20)
    private String tipo; // ex: fixo, celular

    @Column(length = 4)
    private String ddd;

    @Column(length = 20, nullable = false)
    private String numero;
}
