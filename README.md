# Projedo desafio Paynet

Este projeto é uma API desenvolvida com Laravel que implementa autenticação via Sanctum, integração com API externa de CEP, controle de usuários com perfis de acesso e mais.

## 🐳 Como rodar o projeto via Docker

### Pré-requisitos

- Docker
- Docker Compose

### Passos

```bash
git clone https://github.com/fintruso/paynet.git
cd paynet/src
cp .env.example .env
docker-compose up -d --build
docker exec -it app composer install
docker exec -it app php artisan key:generate
docker exec -it app php artisan migrate
```

Acesse o projeto em `http://localhost:8000`

### MailHog

- Interface: http://localhost:8025

## 🔐 Autenticação

A autenticação é realizada via Laravel Sanctum com tokens.

### Rotas públicas

- `POST /api/register` – Cadastro de novo usuário
- `POST /api/login` – Login de usuário
- `POST /api/forgot-password` – Solicitação de recuperação de senha
- `POST /api/reset-password` – Redefinir senha
- `GET /api/cep/{cep}` – Consulta de endereço via CEP (ViaCEP)

### Rotas protegidas (`auth:sanctum`)

- `GET /api/user` – Perfil do usuário autenticado
- `POST /api/logout` – Logout
- `GET /api/users` – Lista de usuários (paginação, filtro por nome e email)

#### Admin (`can:isAdmin`)

- `PUT /api/users/{user}` – Atualizar usuário
- `DELETE /api/users/{user}` – Remover usuário
- `GET /api/dashboard` – Dashboard com métricas básicas

## 🧪 Testes

Execute os testes com:

```bash
docker exec -it app php artisan test
```

- Testes unitários para serviços
- Testes de integração para autenticação

## 🧱 Arquitetura

- Service Layer para regras de negócio
- Repository Pattern para queries (se necessário)
- ServiceProvider para API externa (CEP)
- Event/Listener para recuperação de senha
- Estrutura organizada com Controllers, Models, Services, Requests, Resources

## 💡 Considerações Finais

- Projeto estruturado para ser escalável e seguro
- Segue princípios SOLID
- Uso de Docker para facilitar setup local
- Uso de MailHog para testes de envio de e-mail
