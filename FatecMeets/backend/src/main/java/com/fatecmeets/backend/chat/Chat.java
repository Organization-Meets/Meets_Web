package com.fatecmeets.backend.chat;

import com.fatecmeets.backend.common.Auditable;
import com.fatecmeets.backend.usuario.Usuario;
import jakarta.persistence.*;
import lombok.*;

@Entity
@Table(name = "chats")
@Getter @Setter @NoArgsConstructor @AllArgsConstructor @Builder
public class Chat extends Auditable {
    @Id @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    private String nome;

    @Enumerated(EnumType.STRING)
    private TipoChat tipo = TipoChat.privado;

    @ManyToOne(optional = false) @JoinColumn(name = "usuario_id")
    private Usuario usuario;
}
