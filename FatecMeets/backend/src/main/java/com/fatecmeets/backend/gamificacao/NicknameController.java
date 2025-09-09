package com.fatecmeets.backend.gamificacao;

import lombok.RequiredArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.util.StringUtils;
import org.springframework.web.bind.annotation.*;
import java.util.Map;

@RestController
@RequestMapping("/api/nickname")
@RequiredArgsConstructor
public class NicknameController {
    private final GamificacaoRepository repo;

    @GetMapping("/check")
    public ResponseEntity<?> check(@RequestParam String value) {
        String raw = value == null ? "" : value.trim();
        boolean formatOk = raw.startsWith("@") && !raw.contains(" ") && raw.length() >= 3;
        if (!formatOk) {
            return ResponseEntity.ok(Map.of(
                "available", false,
                "format", false,
                "message", "Formato inválido. Deve começar com @, sem espaços e ter >=3 caracteres"
            ));
        }
        boolean exists = repo.existsByNicknameIgnoreCase(raw.toLowerCase());
        return ResponseEntity.ok(Map.of(
            "available", !exists,
            "format", true,
            "message", exists ? "Já em uso" : "Disponível"
        ));
    }
}
