package com.fatecmeets.backend.usuario;
import jakarta.persistence.*;
import lombok.*;

@Entity
@Table(name="", indexes={@Index(name="idx_usuario_email", columnList="email", unique=true)})
@Getter @Setter @NoArgsConstructor @AllArgsConstructor @Builder
public class Usuario {

    @Id @GeneratedValue(strategy=GenerationType.IDENTITY)
    private Long id;

    @Column(nullable=false, length=120, unique=false)
    private String nome;

    @Column(nullable=false, length=255, unique=true)
    private String email;
    
    @Column(nullable=false, length=255, unique=false)
    private String senha;

    private Enum status;
}
//     id_user        BIGINT AUTO_INCREMENT PRIMARY KEY,
//     nome_usuario   VARCHAR(120) NOT NULL,
//     email          VARCHAR(255) NOT NULL UNIQUE,
//     senha          VARCHAR(255) NOT NULL,
//     user_status    VARCHAR(40),
//     user_img       TEXT,
//     score          INT DEFAULT 0