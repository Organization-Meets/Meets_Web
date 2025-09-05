package com.fatecmeets.backend.telefone;

import com.fatecmeets.backend.common.Auditable;
import jakarta.persistence.*;
import lombok.*;

@Entity
@Table(name = "telefones")
@Getter @Setter @NoArgsConstructor @AllArgsConstructor @Builder
public class Telefone extends Auditable {
    @Id @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    @Column(nullable = false, length = 15)
    private String numero;

    @Column(nullable = false, length = 3)
    private String ddd;

    @Column(length = 15)
    private String tipo;
}
