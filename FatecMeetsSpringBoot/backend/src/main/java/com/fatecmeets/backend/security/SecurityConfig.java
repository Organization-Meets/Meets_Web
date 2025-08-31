package com.fatecmeets.backend.security;

import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;
import org.springframework.security.config.annotation.web.builders.HttpSecurity;
import org.springframework.security.config.annotation.web.configuration.EnableWebSecurity;
import org.springframework.security.crypto.bcrypt.BCryptPasswordEncoder;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.security.web.SecurityFilterChain;
import org.springframework.security.config.Customizer;

@Configuration
@EnableWebSecurity
public class SecurityConfig {

    @Bean
    public PasswordEncoder passwordEncoder() {
        return new BCryptPasswordEncoder();
    }

    @Bean
    public SecurityFilterChain filterChain(HttpSecurity http) throws Exception {
        http
            // CSRF desabilitado para API REST
            .csrf(csrf -> csrf.disable())

            // Autorizações
            .authorizeHttpRequests(auth -> auth
                .requestMatchers("/auth/**").permitAll() // cadastro/login/ativação
                .anyRequest().authenticated()            // resto precisa estar logado
            )

            // Login OAuth2 (Microsoft, Google, etc.)
            .oauth2Login(Customizer.withDefaults())

            // Remember-me
            .rememberMe(remember -> remember
                .key("chave-secreta")
                .tokenValiditySeconds(7 * 24 * 60 * 60) // 7 dias
            );

        return http.build();
    }
}
