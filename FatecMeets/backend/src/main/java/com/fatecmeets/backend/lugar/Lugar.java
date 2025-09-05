package com.fatecmeets.backend.lugar;

import com.fatecmeets.backend.administrador.Administrador;
import com.fatecmeets.backend.common.Auditable;
import com.fatecmeets.backend.endereco.Endereco;
import jakarta.persistence.*;
import lombok.*;

@Entity
@Table(name = "lugares")
@Getter @Setter @NoArgsConstructor @AllArgsConstructor @Builder
public class Lugar extends Auditable {
    @Id @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    @ManyToOne(optional = false) @JoinColumn(name = "endereco_id")
    private Endereco endereco;

    private String nome;

    @ManyToOne @JoinColumn(name = "administrador_id")
    private Administrador administrador;
}
