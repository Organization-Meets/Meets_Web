package com.fatecmeets.backend.gamificacao;

import com.fatecmeets.backend.common.Auditable;
import com.fatecmeets.backend.usuario.Usuario;
import jakarta.persistence.*;
import lombok.*;

@Entity
@Table(name = "gamificacoes", indexes = {
        @Index(name = "uk_gamificacoes_nickname", columnList = "nickname", unique = true)
})
@Getter @Setter @NoArgsConstructor @AllArgsConstructor @Builder
public class Gamificacao extends Auditable {
    @Id @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    private Integer scoreTotal = 0;

    private String nickname;

    @ManyToOne(optional = false) @JoinColumn(name = "usuario_id")
    private Usuario usuario;
}
