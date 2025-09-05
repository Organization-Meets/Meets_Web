package com.fatecmeets.backend.aluno;

import com.fatecmeets.backend.common.Auditable;
import com.fatecmeets.backend.usuario.Usuario;
import jakarta.persistence.*;
import lombok.*;

@Entity
@Table(name = "alunos", indexes = {
        @Index(name = "uk_alunos_ra", columnList = "ra", unique = true)
})
@Getter @Setter @NoArgsConstructor @AllArgsConstructor @Builder
public class Aluno extends Auditable {
    @Id @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    @ManyToOne(optional = false) @JoinColumn(name = "usuario_id")
    private Usuario usuario;

    private String nome;

    @Column(length = 20, unique = true, nullable = false)
    private String ra;
}
