package com.fatecmeets.backend.roles;

import com.fatecmeets.backend.aluno.Aluno;
import com.fatecmeets.backend.aluno.AlunoRepository;
import com.fatecmeets.backend.academico.Academico;
import com.fatecmeets.backend.academico.AcademicoRepository;
import com.fatecmeets.backend.usuario.UsuarioRepository;
import com.fatecmeets.backend.token.TokenService;
import com.fatecmeets.backend.gamificacao.GamificacaoRepository;
import com.fatecmeets.backend.gamificacao.Gamificacao;
import lombok.Data;
import lombok.RequiredArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.util.StringUtils;
import org.springframework.web.bind.annotation.*;

import java.util.*;

@RestController
@RequestMapping("/api/roles")
@RequiredArgsConstructor
public class RoleController {

    private final TokenService tokenService;
    private final UsuarioRepository usuarios;
    private final AlunoRepository alunos;
    private final AcademicoRepository academicos;
    private final GamificacaoRepository gamificacoes;

    @PostMapping("/aluno")
    public ResponseEntity<?> tornarAluno(@RequestHeader(value = "Authorization", required = false) String auth,
                                         @RequestBody RoleRequest req) {
        var uid = tokenService.extractUsuarioId(auth);
        if (uid == null) return ResponseEntity.status(401).body(Map.of("error","token inválido"));
        if (!validar(req)) return ResponseEntity.badRequest().body(Map.of("error","nome e RA obrigatórios"));
        if (alunos.findByRa(req.getRa()).isPresent() || academicos.findByRa(req.getRa()).isPresent()) {
            return ResponseEntity.status(409).body(Map.of("error","RA já utilizado"));
        }
        var usuario = usuarios.findById(uid).orElse(null);
        if (usuario == null) return ResponseEntity.status(404).body(Map.of("error","usuário não encontrado"));
        if (alunos.existsByUsuarioId(uid)) return ResponseEntity.ok(Map.of("message","já é aluno"));
        alunos.save(Aluno.builder().usuario(usuario).nome(req.getNome()).ra(req.getRa()).build());
        garantirGamificacao(usuario, req.getNome());
        return ResponseEntity.ok(Map.of("message","Perfil de aluno adicionado","roles", rolesDoUsuario(uid)));
    }

    @PostMapping("/academico")
    public ResponseEntity<?> tornarAcademico(@RequestHeader(value = "Authorization", required = false) String auth,
                                             @RequestBody RoleRequest req) {
        var uid = tokenService.extractUsuarioId(auth);
        if (uid == null) return ResponseEntity.status(401).body(Map.of("error","token inválido"));
        if (!validar(req)) return ResponseEntity.badRequest().body(Map.of("error","nome e RA obrigatórios"));
        if (alunos.findByRa(req.getRa()).isPresent() || academicos.findByRa(req.getRa()).isPresent()) {
            return ResponseEntity.status(409).body(Map.of("error","RA já utilizado"));
        }
        var usuario = usuarios.findById(uid).orElse(null);
        if (usuario == null) return ResponseEntity.status(404).body(Map.of("error","usuário não encontrado"));
        if (academicos.existsByUsuarioId(uid)) return ResponseEntity.ok(Map.of("message","já é acadêmico"));
        academicos.save(Academico.builder().usuario(usuario).nome(req.getNome()).ra(req.getRa()).build());
        garantirGamificacao(usuario, req.getNome());
        return ResponseEntity.ok(Map.of("message","Perfil de acadêmico adicionado","roles", rolesDoUsuario(uid)));
    }

    private boolean validar(RoleRequest r) {
        return r != null && StringUtils.hasText(r.getNome()) && StringUtils.hasText(r.getRa());
    }

    private List<String> rolesDoUsuario(Long uid) {
        var list = new ArrayList<String>();
        if (alunos.existsByUsuarioId(uid)) list.add("aluno");
        if (academicos.existsByUsuarioId(uid)) list.add("academico");
        return list;
    }

    private void garantirGamificacao(com.fatecmeets.backend.usuario.Usuario u, String nomeBase) {
        // Gera nickname se ainda não existir uma gamificação para o usuário
        // Pressupõe (usuario_id) único em gamificações? Se não, apenas se ausência de alguma existente
        // Simplificado: sempre cria se usuário ainda não tem registro
        boolean jaTem = gamificacoes.findAll().stream().anyMatch(g -> g.getUsuario().getId().equals(u.getId()));
        if (jaTem) return;
        String base = (nomeBase == null || nomeBase.isBlank() ? u.getEmail().split("@")[0] : nomeBase)
                .toLowerCase().replaceAll("[^a-z0-9]","-").replaceAll("-+","-");
        if (base.isBlank()) base = "user" + u.getId();
        String nick = base; int c=1; while (gamificacoes.existsByNickname(nick)) nick = base + c++;
        gamificacoes.save(Gamificacao.builder().usuario(u).nickname(nick).scoreTotal(0).build());
    }

    @Data
    public static class RoleRequest {
        private String nome;
        private String ra;
    }
}
