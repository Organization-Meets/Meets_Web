package com.fatecmeets.backend.email;

import lombok.RequiredArgsConstructor;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.beans.factory.annotation.Value;
import org.springframework.lang.NonNull;
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

  public void sendTokenEmail(@NonNull String to, @NonNull String token) {
    try {
      SimpleMailMessage msg = new SimpleMailMessage();
      if (StringUtils.hasText(fromAddress)) {
        msg.setFrom(fromName + " <" + fromAddress + ">");
      }
      msg.setTo(to);
      msg.setSubject("Seu token de login - FatecMeets");
      msg.setText("Seu token é: " + token);
      mailSender.send(msg);
      log.info("Token enviado por e-mail para {}", to);
    } catch (Exception ex) {
      log.warn("Não foi possível enviar e-mail. Token para {}: {}", to, token);
    }
  }
}
