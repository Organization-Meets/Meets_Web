package com.fatecmeets.backend.mensagem;

import com.fatecmeets.backend.chat.Chat;
import com.fatecmeets.backend.common.Auditable;
import com.fatecmeets.backend.usuario.Usuario;
import jakarta.persistence.*;
import lombok.*;

@Entity
@Table(name = "mensagens")
@Getter @Setter @NoArgsConstructor @AllArgsConstructor @Builder
public class Mensagem extends Auditable {
    @Id @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    @Column(columnDefinition = "TEXT", nullable = false)
    private String conteudo;

    @ManyToOne(optional = false) @JoinColumn(name = "chat_id")
    private Chat chat;

    @ManyToOne(optional = false) @JoinColumn(name = "usuario_id")
    private Usuario usuario;
}
