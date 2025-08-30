package com.fatecmeets.backend.auth;

import org.springframework.mail.SimpleMailMessage;
import org.springframework.mail.javamail.JavaMailSender;
import org.springframework.stereotype.Service;

@Service
public class EmailService {
    private final JavaMailSender mailSender;

    public EmailService(JavaMailSender mailSender) {
        this.mailSender = mailSender;
    }

    public void enviarToken(String to, String token, String tipo) {
        String assunto = tipo.equals("ATIVACAO") ? "Ative sua conta" : "Confirme seu login";
        String link = tipo.equals("ATIVACAO")
            ? "https://urban-garbanzo-jjg995v9jp4q2q9vw-8080.app.github.dev/auth/activate?token=" + token
            : "https://urban-garbanzo-jjg995v9jp4q2q9vw-8080.app.github.dev/auth/confirm-login?token=" + token;

        SimpleMailMessage msg = new SimpleMailMessage();
        msg.setTo(to);
        msg.setSubject(assunto);
        msg.setText("Clique no link: " + link);
        mailSender.send(msg);
    }
}
