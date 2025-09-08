package com.fatecmeets.backend.email;

import lombok.RequiredArgsConstructor;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.beans.factory.annotation.Value;
import org.springframework.mail.SimpleMailMessage;
import org.springframework.mail.javamail.JavaMailSender;
import org.springframework.stereotype.Service;
import org.springframework.util.StringUtils;

@Service
@RequiredArgsConstructor
public class EmailService {
  private static final Logger log = LoggerFactory.getLogger(EmailService.class);
  private final JavaMailSender mailSender;

  @Value("${app.mail.from.address:}")
  private String fromAddress;

  @Value("${app.mail.from.name:Fatec Meets}")
  private String fromName;

  private void sendGeneric(String to, String subject, String body) {
    try {
      SimpleMailMessage msg = new SimpleMailMessage();
      if (StringUtils.hasText(fromAddress)) {
        msg.setFrom(fromName + " <" + fromAddress + ">");
      }
      msg.setTo(to);
      msg.setSubject(subject);
      msg.setText(body);
      mailSender.send(msg);
      log.info("E-mail '{}' enviado para {}", subject, to);
    } catch (Exception ex) {
      log.warn("Falha envio e-mail '{}'. Conteúdo fallback: {} - erro: {}", subject, body, ex.getMessage());
    }
  }

  public void sendVerificationEmail(String to, String token) {
    sendGeneric(to, "Verificação de e-mail - FatecMeets",
        "Seu código de verificação é: " + token + "\nExpira em 15 minutos.");
  }

  public void sendLoginTokenEmail(String to, String token) {
    sendGeneric(to, "Token de login - FatecMeets",
        "Seu token de login é: " + token + "\nExpira em 10 minutos.");
  }

  @Deprecated
  public void sendTokenEmail(String to, String token) {
    sendVerificationEmail(to, token);
  }

  // ==== NOVOS MÉTODOS ====
  public void sendPlain(String to, String subject, String body) {
    sendGeneric(to, subject, body);
  }

  public void sendAdminInviteEmail(String to, String link) {
    String body = "Você recebeu um convite para se tornar Administrador no FatecMeets.\n\n" +
        "Acesse o link único (válido por 24h):\n" + link + "\n\n" +
        "Se você não solicitou este convite, ignore este e-mail.";
    sendGeneric(to, "Convite Administrador - FatecMeets", body);
  }
}
