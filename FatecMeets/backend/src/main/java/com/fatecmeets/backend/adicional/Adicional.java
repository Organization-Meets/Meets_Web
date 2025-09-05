package com.fatecmeets.backend.adicional;

import com.fatecmeets.backend.common.Auditable;
import com.fatecmeets.backend.endereco.Endereco;
import com.fatecmeets.backend.instituicao.Instituicao;
import com.fatecmeets.backend.telefone.Telefone;
import com.fatecmeets.backend.usuario.Usuario;
import jakarta.persistence.*;
import lombok.*;

@Entity
@Table(name = "adicionais")
@Getter @Setter @NoArgsConstructor @AllArgsConstructor @Builder
public class Adicional extends Auditable {
    @Id @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    @ManyToOne(optional = false) @JoinColumn(name = "usuario_id")
    private Usuario usuario;

    @ManyToOne @JoinColumn(name = "telefone_id")
    private Telefone telefone;

    @ManyToOne @JoinColumn(name = "endereco_id")
    private Endereco endereco;

    @ManyToOne @JoinColumn(name = "instituicao_id")
    private Instituicao instituicao;
}
