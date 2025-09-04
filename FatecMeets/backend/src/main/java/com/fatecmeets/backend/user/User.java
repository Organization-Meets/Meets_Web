package com.fatecmeets.backend.user;

import jakarta.persistence.*;
import lombok.*;
import java.time.Instant;

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

  private String passwordHash;

  private String microsoftId;

  @Builder.Default
  private String roles = "USER";

  @Builder.Default
  private boolean verified = false;

  private String loginToken;
  private Instant loginTokenExpiresAt;

  @Builder.Default
  private Instant createdAt = Instant.now();
}
