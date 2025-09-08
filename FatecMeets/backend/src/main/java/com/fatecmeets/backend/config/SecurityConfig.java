package com.fatecmeets.backend.config;

import org.springframework.beans.factory.ObjectProvider;
import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;
import org.springframework.security.config.Customizer;
import org.springframework.security.config.annotation.web.builders.HttpSecurity;
import org.springframework.security.crypto.bcrypt.BCryptPasswordEncoder;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.security.web.SecurityFilterChain;
import org.springframework.security.oauth2.client.registration.ClientRegistrationRepository;

@Configuration
public class SecurityConfig {

  @Bean
  SecurityFilterChain securityFilterChain(
      HttpSecurity http,
      ObjectProvider<ClientRegistrationRepository> clients // opcional
  ) throws Exception {
    http
      .csrf(csrf -> csrf.disable())
      .cors(Customizer.withDefaults())
      .authorizeHttpRequests(auth -> auth
        .requestMatchers(
          "/actuator/health",
          "/api/auth/**",
          "/error",
          "/oauth2/**",
          "/login/**",
          "/api/roles/**"
        ).permitAll()
        .anyRequest().authenticated()
      );

    // Ativa OAuth2 login somente se houver configuração de cliente (Azure) disponível
    if (clients.getIfAvailable() != null) {
      http.oauth2Login(oauth -> oauth.defaultSuccessUrl("/", true));
    }

    return http.build();
  }

  @Bean
  PasswordEncoder passwordEncoder() {
    return new BCryptPasswordEncoder();
  }
}
