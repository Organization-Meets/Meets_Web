package com.fatecmeets.backend.admin;

import lombok.RequiredArgsConstructor;
import org.slf4j.Logger;import org.slf4j.LoggerFactory;
import org.springframework.beans.factory.annotation.Value;
import org.springframework.boot.CommandLineRunner;
import org.springframework.stereotype.Component;

@Component
@RequiredArgsConstructor
public class AdminInviteRunner implements CommandLineRunner {
    private static final Logger log = LoggerFactory.getLogger(AdminInviteRunner.class);
    private final AdminInviteRepository repo;
    private final AdminInviteService service;

    @Value("${app.admin.initial-email:}")
    private String initialEmail;

    @Override
    public void run(String... args) {
        if (initialEmail == null || initialEmail.isBlank()) {
            log.info("Admin invite: e-mail inicial não configurado (app.admin.initial-email)");
            return;
        }
        long count = repo.count();
        if (count == 0) {
            var inv = service.generateAndSend(initialEmail);
            log.info("Convite administrador gerado e enviado. Token={} email={} expira={}", inv.getToken(), initialEmail, inv.getExpiresAt());
        } else {
            log.info("Convites já existentes: {} — não gerado novo.", count);
        }
    }
}
