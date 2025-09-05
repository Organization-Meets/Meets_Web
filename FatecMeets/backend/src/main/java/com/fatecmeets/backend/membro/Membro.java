package com.fatecmeets.backend.membro;

import com.fatecmeets.backend.chat.Chat;
import com.fatecmeets.backend.common.Auditable;
import com.fatecmeets.backend.usuario.Usuario;
import jakarta.persistence.*;
import lombok.*;

@Entity
@Table(name = "membros",
        uniqueConstraints = @UniqueConstraint(name = "uk_membros_chat_usuario", columnNames = {"chat_id","usuario_id"}))
@Getter @Setter @NoArgsConstructor @AllArgsConstructor @Builder
public class Membro extends Auditable {
    @Id @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    @ManyToOne(optional = false) @JoinColumn(name = "chat_id")
    private Chat chat;

    @ManyToOne(optional = false) @JoinColumn(name = "usuario_id")
    private Usuario usuario;

    @Enumerated(EnumType.STRING)
    private MembroRole role = MembroRole.membro;
}
