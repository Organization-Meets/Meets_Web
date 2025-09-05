package com.fatecmeets.backend.rede;

import com.fatecmeets.backend.adicional.Adicional;
import com.fatecmeets.backend.common.Auditable;
import jakarta.persistence.*;
import lombok.*;

@Entity
@Table(name = "redes")
@Getter @Setter @NoArgsConstructor @AllArgsConstructor @Builder
public class Rede extends Auditable {
    @Id @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    @ManyToOne(optional = false) @JoinColumn(name = "adicional_id")
    private Adicional adicional;

    @Enumerated(EnumType.STRING)
    private TipoRede tipo;

    @Column(length = 500, nullable = false)
    private String url;
}
