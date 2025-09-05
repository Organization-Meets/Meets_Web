# Fatec Meets
Projeto Integrador

## Frontend (Vite React)
Fluxo:
1. Cadastro local (/api/auth/register-local) -> recebe código por e-mail.
2. Verificação (/api/auth/verify-email).
3. Login em 2 passos (request-login-token -> login-local).
4. Após login: painel CRUD genérico (Dashboard) para entidades.

Tokens:
- accessToken: sessionStorage
- refreshToken: localStorage (quando lembrar-me)

## Painel CRUD
Arquivos chave:
- src/api/client.js (fetch + renovação de token)
- src/api/endpoints.js (metadados de entidades/fields)
- src/components/EntityTable.jsx (tabela + form)
- src/components/Dashboard.jsx (navegação lateral)
- src/components/AuthFlow.jsx (fluxo de login)
- src/App.jsx (orquestra views)

Para adicionar nova entidade:
1. Editar src/api/endpoints.js
2. Backend deve expor REST: 
   GET /api/<entidade>
   GET /api/<entidade>/{id}
   POST /api/<entidade>
   PUT /api/<entidade>/{id}
   DELETE /api/<entidade>/{id}

## Backend
Spring Boot + JPA + Security (login e-mail + token).
Tabela auth_tokens para access/refresh simples (não JWT).

## Scripts úteis
docker compose up -d
mvn spring-boot:run (dentro backend)
npm run dev (frontend local) ou usar container existente.

## Admin
Frontend admin em desenvolvimento:
- Estrutura básica pronta.
- Integração com backend pendente.
- Acesso restrito a usuários admin.

Endpoints principais:
- GET /api/admin/users: lista de usuários.
- POST /api/admin/users: criar novo usuário.
- GET /api/admin/users/{id}: detalhes do usuário.
- PUT /api/admin/users/{id}: atualizar usuário.
- DELETE /api/admin/users/{id}: remover usuário.

Acesso:
- Apenas para usuários com perfil admin.
- Necessário token de acesso válido.

Observações:
- Testes em andamento.
- Documentação da API será atualizada.
