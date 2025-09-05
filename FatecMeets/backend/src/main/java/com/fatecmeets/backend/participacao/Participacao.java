package com.fatecmeets.backend.participacao;

import com.fatecmeets.backend.atividade.Atividade;
import com.fatecmeets.backend.common.Auditable;
import com.fatecmeets.backend.evento.Evento;
import com.fatecmeets.backend.usuario.Usuario;
import jakarta.persistence.*;
import lombok.*;

@Entity
@Table(name = "participacoes",
        uniqueConstraints = @UniqueConstraint(name = "uq_participacao_usuario_evento", columnNames = {"usuario_id","evento_id"}))
@Getter @Setter @NoArgsConstructor @AllArgsConstructor @Builder
public class Participacao extends Auditable {
    @Id @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    @ManyToOne(optional = false) @JoinColumn(name = "evento_id")
    private Evento evento;

    @ManyToOne(optional = false) @JoinColumn(name = "usuario_id")
    private Usuario usuario;

    @ManyToOne @JoinColumn(name = "atividade_id")
    private Atividade atividade;

    @Enumerated(EnumType.STRING)
    private StatusIntencao statusIntencao = StatusIntencao.aberto;
}
