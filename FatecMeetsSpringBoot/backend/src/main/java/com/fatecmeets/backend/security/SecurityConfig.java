package com.fatecmeets.backend.security;

import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;
import org.springframework.security.config.annotation.web.builders.HttpSecurity;
import org.springframework.security.crypto.bcrypt.BCryptPasswordEncoder;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.security.web.SecurityFilterChain;
import org.springframework.security.config.Customizer;
import org.springframework.web.cors.CorsConfiguration;
import org.springframework.web.cors.CorsConfigurationSource;
import org.springframework.web.cors.UrlBasedCorsConfigurationSource;
import org.springframework.web.filter.ForwardedHeaderFilter;
import org.springframework.boot.web.servlet.FilterRegistrationBean;

import java.util.List;

@Configuration
public class SecurityConfig {

    @Bean
    public PasswordEncoder passwordEncoder() {
        return new BCryptPasswordEncoder();
    }

    @Bean
    public SecurityFilterChain filterChain(HttpSecurity http) throws Exception {
        http
            .csrf(csrf -> csrf.disable())
            .cors(Customizer.withDefaults())
            .authorizeHttpRequests(auth -> auth
                // libera login/cadastro
                .requestMatchers("/auth/register", "/auth/login").permitAll()
                // libera os endpoints do fluxo OAuth2
                .requestMatchers("/oauth2/**").permitAll()
                // qualquer outra rota precisa estar autenticada
                .anyRequest().authenticated()
            )
            // só ativa OAuth2 para quem clicar no "Login Microsoft"
            .oauth2Login(Customizer.withDefaults())
            .rememberMe(remember -> remember
                .key("chave-secreta")
                .tokenValiditySeconds(7 * 24 * 60 * 60)
            );

        return http.build();
    }

    @Bean
    public CorsConfigurationSource corsConfigurationSource() {
        CorsConfiguration config = new CorsConfiguration();
        config.setAllowCredentials(true);

        config.setAllowedOrigins(List.of(
            "http://localhost:3000",
            "http://localhost:8080",
            "https://urban-garbanzo-jjg995v9jp4q2q9vw-3000.app.github.dev",
            "https://urban-garbanzo-jjg995v9jp4q2q9vw-8080.app.github.dev"
        ));

        config.setAllowedHeaders(List.of("*"));
        config.setAllowedMethods(List.of("GET", "POST", "PUT", "DELETE", "OPTIONS"));

        UrlBasedCorsConfigurationSource source = new UrlBasedCorsConfigurationSource();
        source.registerCorsConfiguration("/**", config);
        return source;
    }

    // 🔑 Corrige o problema de host/porta no Codespaces (remove o :8080)
    @Bean
    public FilterRegistrationBean<ForwardedHeaderFilter> forwardedHeaderFilter() {
        FilterRegistrationBean<ForwardedHeaderFilter> filterRegBean = new FilterRegistrationBean<>();
        filterRegBean.setFilter(new ForwardedHeaderFilter());
        filterRegBean.setOrder(0);
        return filterRegBean;
    }
}
