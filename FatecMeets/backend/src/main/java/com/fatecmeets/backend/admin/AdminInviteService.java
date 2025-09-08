package com.fatecmeets.backend.admin;

import com.fatecmeets.backend.email.EmailService;
import lombok.RequiredArgsConstructor;
import org.springframework.stereotype.Service;

import java.security.SecureRandom;
import java.util.HexFormat;

@Service
@RequiredArgsConstructor
public class AdminInviteService {
    private final AdminInviteRepository repo;
    private final EmailService emailService;
    private final SecureRandom random = new SecureRandom();

    public AdminInvite generateAndSend(String email) {
        String token = HexFormat.of().formatHex(random.generateSeed(24));
        var invite = repo.save(AdminInvite.builder().token(token).build());
        String link = "https://didactic-cod-7v7gr7jrr9g6fr645-8080.app.github.dev/admin-invite/" + token;
        emailService.sendAdminInviteEmail(email, link);
        return invite;
    }
}
