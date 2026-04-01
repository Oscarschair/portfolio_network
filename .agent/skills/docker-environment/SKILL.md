---
name: Docker Environment
description: Skills for managing and developing the Portfolio Network application within a Dockerized environment.
---

# Docker Environment

This skill focuses on using Docker (`docker-compose`) to create a consistent and portable development environment for the Portfolio Network application.

## Core Concepts

### 1. Application Architecture (Dockerized)
The project relies on a 3-container orchestration defined in `docker-compose.yml`:
- **app**: PHP 8.3 with Apache server (mapped to port 8080). It mounts the current directory `/var/www/html` to provide live code reloading.
- **mysql**: MySQL 8.0 database (mapped to port 3306). Persistent volume attached to `mysql_data`.
- **phpmyadmin**: GUI for MySQL database management (mapped to port 8081).

### 2. Container Management
- **Startup**: `docker-compose up -d --build` (Build is essential to capture `Dockerfile` changes like `a2enmod rewrite`).
- **Shutdown**: `docker-compose down`.
- **Shell Access**: `docker-compose exec app bash` to enter the PHP container for direct command-line execution.

### 3. Artisan and Dependency Execution
Since the application runs inside Docker, all PHP-based commands should ideally be executed *within* the `app` container to ensure environment parity (PHP versions, extensions).
- Run migrations: `docker-compose exec app php artisan migrate`
- Clear cache: `docker-compose exec app php artisan route:clear`
However, NPM tasks like `npm run dev` or Windows-specific `php artisan storage:link` (for Junction points over faulty Linux symlinks) can sometimes be run natively on the host machine.

## Best Practices
- **Persistence**: Ensure MySQL data persists in `mysql_data` so migrations/seeders do not drop unexpectedly.
- **`.env` Configuration**: Ensure that `DB_HOST=mysql`, `DB_DATABASE=laravel_db`, and `DB_PASSWORD=password` align identically with the environment variables passed in `docker-compose.yml`.
- **URL Resolution**: Change `APP_URL=http://localhost:8080` to correspond with the Docker exposed port.
