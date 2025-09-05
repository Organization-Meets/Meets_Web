package com.fatecmeets.backend.evento;

import com.fatecmeets.backend.atividade.Atividade;
import com.fatecmeets.backend.common.Auditable;
import com.fatecmeets.backend.complemento.Complemento;
import com.fatecmeets.backend.usuario.Usuario;
import jakarta.persistence.*;
import lombok.*;

import java.time.LocalDate;

@Entity
@Table(name = "eventos")
@Getter @Setter @NoArgsConstructor @AllArgsConstructor @Builder
public class Evento extends Auditable {
    @Id @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    private String nome;

    @Column(columnDefinition = "JSON")
    private String imagem;

    @Column(columnDefinition = "TEXT", nullable = false)
    private String descricao;

    @Column(name = "data_inicio", nullable = false)
    private LocalDate dataInicio;

    @Column(name = "data_final", nullable = false)
    private LocalDate dataFinal;

    @ManyToOne(optional = false) @JoinColumn(name = "complemento_id")
    private Complemento complemento;

    @ManyToOne(optional = false) @JoinColumn(name = "usuario_id")
    private Usuario usuario;

    @ManyToOne @JoinColumn(name = "atividade_id")
    private Atividade atividade;
}
