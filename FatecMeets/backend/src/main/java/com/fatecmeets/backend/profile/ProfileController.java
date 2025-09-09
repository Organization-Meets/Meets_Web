package com.fatecmeets.backend.profile;

import com.fatecmeets.backend.token.TokenService;
import com.fatecmeets.backend.usuario.UsuarioRepository;
import com.fatecmeets.backend.gamificacao.GamificacaoRepository;
import com.fatecmeets.backend.aluno.AlunoRepository;
import com.fatecmeets.backend.academico.AcademicoRepository;
import com.fatecmeets.backend.administrador.AdministradorRepository;
import lombok.RequiredArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.*;

@RestController
@RequestMapping("/api/profile")
@RequiredArgsConstructor
public class ProfileController {

    private final TokenService tokenService;
    private final UsuarioRepository usuarios;
    private final GamificacaoRepository gamificacoes;
    private final AlunoRepository alunos;
    private final AcademicoRepository academicos;
    private final AdministradorRepository administradores;

    @GetMapping("/me")
    public ResponseEntity<?> me(@RequestHeader(value = "Authorization", required = false) String auth) {
        Long uid = tokenService.extractUsuarioId(auth);
        if (uid == null) return ResponseEntity.status(401).body(Map.of("error","unauthorized"));
        var usuarioOpt = usuarios.findById(uid);
        if (usuarioOpt.isEmpty()) return ResponseEntity.status(404).body(Map.of("error","not_found"));
        var usuario = usuarioOpt.get();
        var gam = gamificacoes.findFirstByUsuarioId(uid).orElse(null);
        var roles = new ArrayList<String>();
        if (alunos.existsByUsuarioId(uid)) roles.add("aluno");
        if (academicos.existsByUsuarioId(uid)) roles.add("academico");
        var aluno = alunos.findFirstByUsuarioId(uid).orElse(null);
        var academico = academicos.findFirstByUsuarioId(uid).orElse(null);
        var admin = administradores.findFirstByUsuarioId(uid).orElse(null);
        if (admin != null) roles.add("administrador");
        String nome = aluno != null ? aluno.getNome() : academico != null ? academico.getNome() : admin != null ? admin.getNome() : null;
        Map<String,Object> body = new LinkedHashMap<>();
        body.put("id", usuario.getId());
        body.put("email", usuario.getEmail());
        body.put("imagem", usuario.getImagem());
        body.put("nickname", gam != null ? gam.getNickname() : null);
        body.put("scoreTotal", gam != null ? gam.getScoreTotal() : 0);
        body.put("roles", roles);
        body.put("nome", nome);
        body.put("postagens", List.of()); // placeholder
        body.put("eventos", List.of()); // placeholder
        return ResponseEntity.ok(body);
    }
}
