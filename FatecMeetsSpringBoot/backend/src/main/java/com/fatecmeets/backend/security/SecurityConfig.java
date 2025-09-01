package com.fatecmeets.backend.security;

import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;
import org.springframework.security.config.annotation.web.builders.HttpSecurity;
import org.springframework.security.crypto.bcrypt.BCryptPasswordEncoder;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.security.web.SecurityFilterChain;
import org.springframework.security.config.Customizer;

@Configuration
public class SecurityConfig {

    @Bean
    public PasswordEncoder passwordEncoder() {
        return new BCryptPasswordEncoder();
    }

    @Bean
    public SecurityFilterChain filterChain(HttpSecurity http) throws Exception {
        http
            .csrf(csrf -> csrf.disable()) // CSRF desabilitado para API REST
            .cors(Customizer.withDefaults()) // ativa CORS
            .authorizeHttpRequests(auth -> auth
                .requestMatchers("/auth/login").permitAll()
                .requestMatchers("/auth/register").permitAll()
                .requestMatchers("/auth/confirm-login").permitAll()
                .requestMatchers("/auth/activate").permitAll()
                .requestMatchers("/oauth2/**").permitAll()
                .anyRequest().authenticated()
            )
            .oauth2Login(Customizer.withDefaults())
            .rememberMe(remember -> remember
                .key("chave-secreta")
                .tokenValiditySeconds(7 * 24 * 60 * 60)
            );

        return http.build();
    }
}