package com.fatecmeets.backend.denuncia;

import com.fatecmeets.backend.administrador.Administrador;
import com.fatecmeets.backend.arquivo.ArquivoMorto;
import com.fatecmeets.backend.common.Auditable;
import com.fatecmeets.backend.usuario.Usuario;
import jakarta.persistence.*;
import lombok.*;

@Entity
@Table(name = "denuncias")
@Getter @Setter @NoArgsConstructor @AllArgsConstructor @Builder
public class Denuncia extends Auditable {
    @Id @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    @ManyToOne(optional = false) @JoinColumn(name = "usuario_id")
    private Usuario usuario;

    @ManyToOne(optional = false) @JoinColumn(name = "arquivo_morto_id")
    private ArquivoMorto arquivoMorto;

    @ManyToOne @JoinColumn(name = "administrador_id")
    private Administrador administrador;

    private String tipo;

    @Column(columnDefinition = "TEXT", nullable = false)
    private String descricao;

    @Enumerated(EnumType.STRING)
    private DenunciaStatus status = DenunciaStatus.aberta;
}
