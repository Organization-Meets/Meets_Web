package com.fatecmeets.backend.auth;

import org.springframework.mail.SimpleMailMessage;
import org.springframework.mail.javamail.JavaMailSender;
import org.springframework.stereotype.Service;
import org.springframework.beans.factory.annotation.Value;

@Service
public class EmailService {
    private final JavaMailSender mailSender;

    public EmailService(JavaMailSender mailSender) {
        this.mailSender = mailSender;
    }

    @Value("${app.base-url}")
    private String baseUrl;

    public void enviarToken(String to, String token, String tipo) {
        String assunto;
        String link;

        if ("ATIVACAO".equals(tipo)) {
            assunto = "Ative sua conta";
            link = baseUrl + "/auth/activate?token=" + token;
        } else {
            assunto = "Confirme seu login";
            link = baseUrl + "/auth/confirm-login?token=" + token;
        }

        SimpleMailMessage msg = new SimpleMailMessage();
        msg.setTo(to);
        msg.setSubject(assunto);
        msg.setText("Clique no link para continuar: " + link);

        mailSender.send(msg);
    }
}
