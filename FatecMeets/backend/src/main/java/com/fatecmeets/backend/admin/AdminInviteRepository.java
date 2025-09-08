package com.fatecmeets.backend.admin;

import org.springframework.data.jpa.repository.JpaRepository;

import java.util.Optional;

public interface AdminInviteRepository extends JpaRepository<AdminInvite, Long> {
    Optional<AdminInvite> findByTokenAndUsedFalse(String token);
}
