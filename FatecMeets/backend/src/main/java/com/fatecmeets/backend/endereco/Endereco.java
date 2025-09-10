package com.fatecmeets.backend.endereco;

import com.fatecmeets.backend.common.Auditable;
import jakarta.persistence.*;
import lombok.*;

@Entity
@Table(name = "enderecos")
@Getter @Setter @NoArgsConstructor @AllArgsConstructor @Builder
public class Endereco extends Auditable {
    @Id @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    @Column(length = 15)
    private String cep;

    @Column(length = 20)
    private String numero;
}
