package com.fatecmeets.backend.token;

import com.fatecmeets.backend.usuario.Usuario;
import jakarta.persistence.*;
import java.time.LocalDateTime;

@Entity
public class Token {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    @Column(unique = true, nullable = false)
    private String token;

    @ManyToOne(optional = false, fetch = FetchType.LAZY)
    private Usuario usuario;

    @Column(nullable = false)
    private LocalDateTime expiraEm;

    @Column(nullable = false)
    private String tipo;

    public Long getId() { return id; }

    public String getToken() { return token; }
    public void setToken(String token) { this.token = token; }

    public Usuario getUsuario() { return usuario; }
    public void setUsuario(Usuario usuario) { this.usuario = usuario; }

    public LocalDateTime getExpiraEm() { return expiraEm; }
    public void setExpiraEm(LocalDateTime expiraEm) { this.expiraEm = expiraEm; }

    public String getTipo() { return tipo; }
    public void setTipo(String tipo) { this.tipo = tipo; }
}
