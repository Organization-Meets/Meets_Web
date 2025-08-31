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
            .csrf(csrf -> csrf.disable()) // CSRF desabilitado para API REST
            .authorizeHttpRequests(auth -> auth
                .requestMatchers("/auth/**").permitAll() // Cadastro/login/ativação liberados
                .anyRequest().authenticated()           // Restante precisa estar logado
            )
            .oauth2Login(Customizer.withDefaults()) // Login OAuth2
            .rememberMe(remember -> remember
                .key("chave-secreta")
                .tokenValiditySeconds(7 * 24 * 60 * 60) // 7 dias
            );

        return http.build();
    }
}
