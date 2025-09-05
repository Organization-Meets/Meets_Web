package com.fatecmeets.backend.user;

import jakarta.persistence.*;
import lombok.*;
import java.time.Instant;
import java.util.List;
import java.util.ArrayList;
import com.fatecmeets.backend.token.Token;

@Entity
@Table(name = "users", indexes = {
  @Index(name = "uk_user_email", columnList = "email", unique = true)
})
@Getter @Setter @NoArgsConstructor @AllArgsConstructor @Builder
public class User {
  @Id @GeneratedValue(strategy = GenerationType.IDENTITY)
  private Long id;

  @Column(nullable = false, unique = true)
  private String email;

  // Coluna obrigatória existente no dump (name NOT NULL)
  @Column(name = "name", nullable = false, length = 255)
  private String name;

  // Mapear para coluna existente 'password'
  @Column(name = "password", length = 255)
  private String passwordHash;

  private String microsoftId;

  @Builder.Default
  private String roles = "USER";

  @Builder.Default
  private boolean verified = false;

  private String loginToken;
  private Instant loginTokenExpiresAt;

  // Token de verificação de e-mail (novo, diferente do loginToken)
  private String verificationToken;
  private Instant verificationTokenExpiresAt;

  @Builder.Default
  private Instant createdAt = Instant.now();

  @OneToMany(mappedBy = "user", cascade = CascadeType.ALL, orphanRemoval = true)
  private List<Token> tokens = new ArrayList<>();

  // Controle de token de login
  @Builder.Default
  private Integer loginTokenAttempts = 0;

  private Instant lastLoginTokenSentAt;

  // método utilitário opcional
  public void addToken(Token t){
    tokens.add(t);
    t.setUser(this);
  }

  @PrePersist
  void prePersist() {
    if (email != null) {
      email = email.trim().toLowerCase();
    }
    if ((name == null || name.isBlank()) && email != null && !email.isBlank()) {
      int at = email.indexOf('@');
      String local = at > 0 ? email.substring(0, at) : email;
      if (!local.isEmpty()) {
        this.name = Character.toUpperCase(local.charAt(0)) + (local.length() > 1 ? local.substring(1) : "");
      } else {
        this.name = "User";
      }
    }
    if (createdAt == null) createdAt = Instant.now();
  }
}
