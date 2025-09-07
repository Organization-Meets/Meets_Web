package com.fatecmeets.backend.usuario;

import com.fatecmeets.backend.common.Auditable;
import jakarta.persistence.*;
import lombok.*;

@Entity
@Table(name = "usuarios", indexes = {
        @Index(name = "uk_usuarios_email", columnList = "email", unique = true)
})
@Getter @Setter @NoArgsConstructor @AllArgsConstructor @Builder
public class Usuario extends Auditable {

    @Id @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    @Column(nullable = false, length = 255, unique = true)
    private String email;

    @Column(nullable = false, length = 255)
    private String password;

    @Column(name = "email_verification_token", length = 10)
    private String emailVerificationToken;

    @Column(columnDefinition = "JSON")
    private String imagem;

    @Enumerated(EnumType.STRING)
    private UsuarioStatus status = UsuarioStatus.ativo;

    @Column(name = "email_verified_at")
    private java.time.Instant emailVerifiedAt;

    @Column(name = "remember_token", length = 100)
    private String rememberToken;

    @Column(name = "login_token", length = 12)
    private String loginToken;

    private java.time.Instant loginTokenExpiresAt;

    @Builder.Default
    private Integer loginTokenAttempts = 0;

    private java.time.Instant lastLoginTokenSentAt;

    // Conveniência para reutilizar lógica antiga de verificação
    public boolean isVerified() {
        return this.status == UsuarioStatus.ativo;
    }
}
