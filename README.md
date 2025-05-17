# Projedo desafio Paynet

Este projeto é uma API desenvolvida com Laravel que implementa autenticação via Sanctum, integração com API externa de CEP, controle de usuários com perfis de acesso e mais.

## 🐳 Como rodar o projeto via Docker

### Pré-requisitos

- Docker
- Docker Compose

### Passos

```bash
git clone https://github.com/fintruso/paynet.git
cd paynet
cp src/.env.example src/.env
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

### 📌 Rotas públicas

#### `POST /api/register` – Cadastro de novo usuário

**Payload**:

```json
{
  "name": "João da Silva",
  "email": "joao2@teste.com",
  "password": "senha123",
  "password_confirmation": "senha123",
  "cep": "01001000",
  "numero": "1234"
}
```

**Resposta esperada**:

```json
{
  "message": "Usuário registrado com sucesso",
  "user": {
    "name": "João da Silva",
    "email": "joao2@teste.com",
    "role": "user",
    "logradouro": "Praça da Sé",
    "bairro": "Sé",
    "cidade": "São Paulo",
    "estado": "SP",
    "numero": "1234",
    "cep": "01001000",
    "updated_at": "...",
    "created_at": "...",
    "id": 2
  }
}
```

---

#### `POST /api/login` – Login de usuário

**Payload**:

```json
{
  "email": "joao@teste.com",
  "password": "novasenha123"
}
```

**Resposta esperada**:

```json
{
  "access_token": "TOKEN_SANCTUM_AQUI",
  "token_type": "Bearer"
}
```

---

#### `POST /api/password/forgot` – Recuperação de senha

**Payload**:

```json
{
  "email": "joao@teste.com"
}
```

**Resposta esperada**:

```json
{
  "message": "E-mail de recuperação enviado!"
}
```

---

#### `POST /api/password/reset` – Redefinir senha

**Payload**:

```json
{
  "email": "joao@teste.com",
  "token": "TOKEN_RECEBIDO_POR_EMAIL",
  "password": "novasenha123",
  "password_confirmation": "novasenha123"
}
```

**Resposta esperada**:

```json
{
  "message": "Senha redefinida com sucesso!"
}
```

---

#### `GET /api/cep/{cep}` – Consulta de CEP

**Resposta esperada** (exemplo com `01001000`):

```json
{
  "logradouro": "Praça da Sé",
  "bairro": "Sé",
  "cidade": "São Paulo",
  "estado": "SP"
}
```

---

#### `GET /api/teste` – Teste de rota

Resposta:

```json
{
  "mensagem": "rota funcionando"
}
```

---

### 🔒 Rotas protegidas (`auth:sanctum`)

#### `GET /api/user` – Perfil do usuário autenticado  
#### `POST /api/logout` – Logout  
#### `GET /api/users` – Lista de usuários (paginação, filtro por nome e email)

---

### 🛡️ Rotas de administrador (`can:isAdmin`)

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