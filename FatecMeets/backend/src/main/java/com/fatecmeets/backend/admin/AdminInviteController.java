package com.fatecmeets.backend.admin;

import com.fatecmeets.backend.usuario.*;
import com.fatecmeets.backend.administrador.*;
import com.fatecmeets.backend.gamificacao.GamificacaoRepository;
import com.fatecmeets.backend.gamificacao.Gamificacao;
import lombok.Data;
import lombok.RequiredArgsConstructor;
import org.slf4j.Logger;import org.slf4j.LoggerFactory;
import org.springframework.http.ResponseEntity;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.transaction.annotation.Transactional;
import org.springframework.util.StringUtils;
import org.springframework.web.bind.annotation.*;

import java.time.Instant;
import java.util.Map;

@RestController
@RequestMapping("/api/admin-invite")
@RequiredArgsConstructor
public class AdminInviteController {

    private static final Logger log = LoggerFactory.getLogger(AdminInviteController.class);

    private final AdminInviteService service;
    private final AdminInviteRepository invites;
    private final UsuarioRepository usuarios;
    private final AdministradorRepository administradores;
    private final GamificacaoRepository gamificacoes;
    private final PasswordEncoder passwordEncoder;

    @PostMapping("/generate")
    public ResponseEntity<?> generate() {
        var inv = service.generateAndSend("gabriel.rodrigues106@fatec.sp.gov.br");
        return ResponseEntity.ok(Map.of("token", inv.getToken()));
    }

    @PostMapping("/consume")
    @Transactional
    public ResponseEntity<?> consume(@RequestBody ConsumeRequest req) {
        try {
            if (!StringUtils.hasText(req.getToken()) || !StringUtils.hasText(req.getEmail()) || !StringUtils.hasText(req.getPassword()) || !StringUtils.hasText(req.getNome())) {
                return ResponseEntity.badRequest().body(Map.of("error","token, nome, email e senha são obrigatórios"));
            }
            var opt = invites.findByTokenAndUsedFalse(req.getToken());
            if (opt.isEmpty()) return ResponseEntity.status(404).body(Map.of("error","convite inválido ou já utilizado"));
            var inv = opt.get();
            if (inv.getExpiresAt().isBefore(Instant.now())) return ResponseEntity.status(410).body(Map.of("error","convite expirado"));
            if (usuarios.existsByEmail(req.getEmail())) return ResponseEntity.status(409).body(Map.of("error","email já usado"));

            // cria usuário com senha codificada
            var u = Usuario.builder()
                    .email(req.getEmail())
                    .password(passwordEncoder.encode(req.getPassword()))
                    .status(UsuarioStatus.ativo)
                    .build();
            usuarios.save(u);

            administradores.save(Administrador.builder()
                    .usuario(u)
                    .nome(req.getNome())
                    .ra(StringUtils.hasText(req.getRa()) ? req.getRa() : null)
                    .build());

            // gamificação nickname
            String nickBase = req.getNome().toLowerCase().replaceAll("[^a-z0-9]","-").replaceAll("-+","-");
            if (nickBase.isBlank()) nickBase = req.getEmail().split("@")[0];
            String nick = nickBase; int c=1; while (gamificacoes.existsByNickname(nick)) nick = nickBase + c++;
            gamificacoes.save(Gamificacao.builder().usuario(u).nickname(nick).scoreTotal(0).build());

            inv.setUsed(true); invites.save(inv);
            log.info("Administrador criado via convite token={} email={}", inv.getToken(), u.getEmail());
            return ResponseEntity.ok(Map.of("message","Administrador cadastrado","nickname", nick));
        } catch (Exception ex) {
            log.error("Erro ao consumir convite administrador", ex);
            return ResponseEntity.status(500).body(Map.of("error","falha interna"));
        }
    }

    @Data
    public static class ConsumeRequest {
        private String token;
        private String email;
        private String password;
        private String nome;
        private String ra;
    }
}
