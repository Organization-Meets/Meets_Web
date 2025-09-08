package com.fatecmeets.backend.administrador;

import com.fatecmeets.backend.common.Auditable;
import com.fatecmeets.backend.usuario.Usuario;
import jakarta.persistence.*;
import lombok.*;

@Entity
@Table(name = "administradores", indexes = {
        @Index(name = "uk_administradores_usuario", columnList = "usuario_id", unique = true),
        @Index(name = "uk_administradores_ra", columnList = "ra", unique = true)
})
@Getter @Setter @NoArgsConstructor @AllArgsConstructor @Builder
public class Administrador extends Auditable {
    @Id @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    @ManyToOne(optional = false) @JoinColumn(name = "usuario_id")
    private Usuario usuario;

    @Column(length = 120)
    private String nome;

    @Column(length = 20, unique = true)
    private String ra; // novo
}
