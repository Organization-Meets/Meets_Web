package com.fatecmeets.backend.atividade;

import com.fatecmeets.backend.common.Auditable;
import jakarta.persistence.*;
import lombok.*;

@Entity
@Table(name = "atividades")
@Getter @Setter @NoArgsConstructor @AllArgsConstructor @Builder
public class Atividade extends Auditable {
    @Id @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    private Integer likes = 0;

    @Enumerated(EnumType.STRING)
    private TipoAtividade tipo;
}
