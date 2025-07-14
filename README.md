# TEST TASK

## Core
This repo contains API using  PHP 8.3 & Symfony with PostgreSQL as database and Doctrine ORM.

### Test

Test are implemented using PHPUnit

## Docker and Project Setup

- For local running: [`Dev enviroment`](./app/.env.dev) 
- Local dev and tests: [`Test enviroment`](./app/.env.test)

Configuration is described in [`docker-compose.yaml`](./docker/docker-compose.yaml)
- [`CLI`](./docker/php/cli/Dockerfile) is configured for local dev
- [`FPM`](./docker/php/fpm/Dockerfile) is congfigured for local running.

### Development

Set up PHP CLI and remote interpreter via Docker Compose for local dev.
In your IDE (e.g., PhpStorm), select the same remote interpreter in Test Frameworks for running tests.

### Local running
Navigate to `docker` directory

```bash
cd docker
```

and run:

```bash
docker compose up
```

API will be available at http://localhost:8080.

# Тестовое задание

## Основное
В данном репозитории содержится реализация API на PHP 8.3 и Symfony. В качестве БД выбрана PostgreSQL и Doctrine ORM для работы с ней.

### Тесты
Для тестов используется PHPUnit

## Docker и запуск проекта 

При локальном запуске используется [`dev-окружение`](./app/.env.dev)

При запуске в cli используется [`тестовое окружение`](./app/.env.test)

Конфигурация описана в файле [`docker-compose.yaml`](./docker/docker-compose.yaml)
Для локальной разработки используется образ, основанный на [`Dockerfile`](./docker/php/cli/Dockerfile).

### Разработка проекта

Для разработки проекта необходимо установить cli и настроить удаленный интерпретатор, запущенный через Docker Compose. Для тестов также необходимо выбрать удаленный интерпретатор (в Test Frameworks)

### Локальный запуск проекта 
Перейдите в директорию `docker`

```bash
cd docker
```

и запустите команду:

```bash
docker compose up
```

Приложение с API будет доступно по адресу http://localhost:8080.