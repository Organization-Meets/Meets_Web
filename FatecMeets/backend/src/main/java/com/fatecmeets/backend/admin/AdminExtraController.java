package com.fatecmeets.backend.admin;

import com.fatecmeets.backend.token.TokenService;
import com.fatecmeets.backend.usuario.UsuarioRepository;
import com.fatecmeets.backend.instituicao.*;
import com.fatecmeets.backend.endereco.*;
import com.fatecmeets.backend.complemento.*;
import com.fatecmeets.backend.telefone.*;
import com.fatecmeets.backend.administrador.AdministradorRepository;
import com.fatecmeets.backend.administrador.Administrador;
import lombok.Data;
import lombok.RequiredArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.util.StringUtils;
import org.springframework.web.bind.annotation.*;

import java.util.*;

@RestController
@RequestMapping("/api/admin")
@RequiredArgsConstructor
public class AdminExtraController {

    private final TokenService tokenService;
    private final UsuarioRepository usuarios;
    private final InstituicaoRepository instituicoes;
    private final EnderecoRepository enderecos;
    private final ComplementoRepository complementos;
    private final TelefoneRepository telefones;
    private final AdminInviteService inviteService;
    private final AdministradorRepository administradores;

    private Long authUid(String authHeader) { return tokenService.extractUsuarioId(authHeader); }
    private boolean isAdmin(Long uid) { return administradores.existsByUsuarioId(uid); }

    @PostMapping("/instituicao/full")
    public ResponseEntity<?> criarInstituicaoFull(@RequestHeader(value="Authorization", required=false) String auth,
                                                  @RequestBody NovaInstituicaoFullReq req) {
        Long uid = authUid(auth); if (uid==null) return ResponseEntity.status(401).body(Map.of("error","unauthorized"));
        if (!isAdmin(uid)) return ResponseEntity.status(403).body(Map.of("error","forbidden"));
        if (instituicoes.findAll().stream().anyMatch(i-> i.getAdministrador().getUsuario().getId().equals(uid))) return ResponseEntity.status(409).body(Map.of("error","já possui instituição"));
        if (!StringUtils.hasText(req.getNomeInstituicao()) || !StringUtils.hasText(req.getCodigo()) ) return ResponseEntity.badRequest().body(Map.of("error","nomeInstituicao e codigo obrigatórios"));
        if (instituicoes.findAll().stream().anyMatch(i-> i.getCodigo().equalsIgnoreCase(req.getCodigo()))) return ResponseEntity.status(409).body(Map.of("error","codigo já usado"));

        // Endereço reutilizado ou novo
        Endereco endereco = null;
        if (req.getEnderecoId()!=null) {
            endereco = enderecos.findById(req.getEnderecoId()).orElse(null);
            if (endereco == null) return ResponseEntity.status(404).body(Map.of("error","endereco não encontrado"));
        } else {
            if (!StringUtils.hasText(req.getCep()) || !StringUtils.hasText(req.getNumero())) return ResponseEntity.badRequest().body(Map.of("error","cep e numero obrigatórios para novo endereço"));
            var novo = new Endereco();
            novo.setCep(req.getCep());
            novo.setNumero(req.getNumero());
            endereco = enderecos.save(novo);
        }

        // Complementos iniciais
        if (req.getLugaresPermitidos()!=null) {
            for (String compNome : req.getLugaresPermitidos()) {
                if (StringUtils.hasText(compNome)) {
                    complementos.save(Complemento.builder().endereco(endereco).nome(compNome.trim()).build());
                }
            }
        }

        // Telefone
        if (!StringUtils.hasText(req.getNumeroTelefone()) || !StringUtils.hasText(req.getDddTelefone())) return ResponseEntity.badRequest().body(Map.of("error","telefone (ddd e numero) obrigatório"));
        var tel = telefones.save(Telefone.builder().tipo(req.getTipoTelefone()).ddd(req.getDddTelefone()).numero(req.getNumeroTelefone()).build());

        var admin = administradores.findAll().stream().filter(a-> a.getUsuario().getId().equals(uid)).findFirst().orElse(null);
        if (admin == null) return ResponseEntity.status(404).body(Map.of("error","admin não encontrado"));

        var inst = instituicoes.save(Instituicao.builder()
                .codigo(req.getCodigo())
                .nome(req.getNomeInstituicao())
                .administrador(admin)
                .endereco(endereco)
                .telefone(tel)
                .build());
        return ResponseEntity.ok(inst);
    }

    @PostMapping("/convite-admin")
    public ResponseEntity<?> gerarConvite(@RequestHeader(value="Authorization", required=false) String auth, @RequestBody ConviteReq req) {
        Long uid = authUid(auth); if (uid==null) return ResponseEntity.status(401).body(Map.of("error","unauthorized"));
        if (!isAdmin(uid)) return ResponseEntity.status(403).body(Map.of("error","forbidden"));
        if (!StringUtils.hasText(req.getEmail())) return ResponseEntity.badRequest().body(Map.of("error","email obrigatório"));
        var inv = inviteService.generateAndSend(req.getEmail());
        return ResponseEntity.ok(Map.of("token", inv.getToken()));
    }

    @Data public static class NovaInstituicaoFullReq {
        private String nomeInstituicao; private String codigo;
        private Long enderecoId; private String cep; private String numero; // para novo endereço
        private String tipoTelefone; private String dddTelefone; private String numeroTelefone;
        private List<String> lugaresPermitidos; // complementos
    }

    @Data
    public static class ConviteReq { private String email; }
}
