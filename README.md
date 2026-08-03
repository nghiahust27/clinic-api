# Clinic Management REST API

## Tech Stack

- Ubuntu 24.04
- Laravel
- PHP 8.3
- PostgreSQL 16
- Docker
- Docker Compose

## Environment

| Component | Version |
|---|---|
| Ubuntu | 24.04 |
| Docker Engine | 29.7.1 |
| Docker Compose | v5.3.0 |
| PHP | 8.3 |
| Laravel | 13.23.0 |

## T1.1 - Docker & Laravel Setup

The project is initialized with Laravel and Docker.

At this stage, the application runs in a PHP/Laravel container without a database connection.

### Run the application

```bash
docker compose build
docker compose up -d