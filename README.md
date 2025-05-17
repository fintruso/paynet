# README - API do Desafio Técnico

## Visão Geral

Este projeto é uma API desenvolvida para o desafio técnico, utilizando Docker para facilitar o ambiente e a execução.

---

## Funcionalidades Implementadas

- Endpoint para autenticação via token JWT
- CRUD básico para as entidades principais
- Respostas no formato JSON
- Tratamento básico de erros

---

## Como rodar o projeto com Docker

### Pré-requisitos

- Docker instalado
- Docker Compose instalado

### Passos para rodar

1. Clone o repositório:

```bash
git clone https://github.com/fintruso/paynet.git

2. Execute o Docker Compose para subir os containers:

```bash
docker-compose up -d

3. Acesse a API pelo endereço configurado (exemplo):

http://localhost:8080/api/