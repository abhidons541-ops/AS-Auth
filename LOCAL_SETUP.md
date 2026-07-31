# Local Setup Guide for KeyAuth Source Code

This guide provides instructions on how to set up and run this project locally on your development machine.

---

## Option A: Using Docker Compose (Recommended & Easiest)

Running with Docker Compose is the simplest, cleanest way to spin up the entire stack (PHP-Apache, MySQL 8.0, and Redis) with a single command. It avoids polluting your host machine with complex installations or manual databases.

### Prerequisites
Make sure you have [Docker](https://www.docker.com/products/docker-desktop/) and **Docker Compose** installed on your system.

### Steps
1. **Start the containers**:
   Run the following command in the root of the project:
   ```bash
   docker compose up -d
   ```
   This command will:
   - Build a custom PHP 8.3 image with Apache, `mysqli`, `gd`, and `redis` extensions pre-installed.
   - Automatically copy `includes/credentials.example.php` to `includes/credentials.php` on startup.
   - Run a MySQL 8.0 container and automatically initialize the database schema using `db_structure.sql`.
   - Run a Redis cache container.

2. **Access the application**:
   Open your browser and navigate to:
   - **Main landing page**: [http://localhost:8080](http://localhost:8080)
   - **Login**: [http://localhost:8080/login](http://localhost:8080/login)
   - **Register**: [http://localhost:8080/register](http://localhost:8080/register)

3. **Stop the containers**:
   To stop the local environment, run:
   ```bash
   docker compose down
   ```

---

## Option B: Manual Local Installation

If you prefer not to use Docker, you can set up the environment manually.

### Prerequisites
Ensure your local machine has the following installed:
- **Web server**: Apache (or Nginx) with `mod_rewrite` enabled.
- **PHP**: PHP 8.1+ with the `mysqli`, `gd`, and `redis` extensions installed and enabled.
- **Database**: MySQL or MariaDB.
- **Cache**: Redis server.

### Steps
1. **Set up the Database**:
   - Create a new MySQL/MariaDB database (e.g., named `main`):
     ```sql
     CREATE DATABASE main;
     ```
   - Import the database structure from the `db_structure.sql` file:
     ```bash
     mysql -u your_username -p main < db_structure.sql
     ```

2. **Configure sensitive credentials**:
   - Copy `includes/credentials.example.php` to `includes/credentials.php`:
     ```bash
     cp includes/credentials.example.php includes/credentials.php
     ```
   - Edit `includes/credentials.php` with your local database information (host, username, password, and database name).

3. **Start services**:
   - Ensure your **Redis Server** is running (`redis-server`).
   - Start your local web server (Apache/Nginx) mapping to the repository root directory.
   - *Alternatively, you can run PHP's built-in development server*:
     ```bash
     php -S localhost:8080
     ```

4. **Verify installation**:
   - Open [http://localhost:8080/stats.php](http://localhost:8080/stats.php) in your browser. You should receive a JSON response showing the counts for accounts, applications, licenses, and active users as `"0"`.

---

## Technical Details of our Enhancements

To make this project modern and easily configurable, we have made the following improvements:
- **Environment Variable Support**: `includes/credentials.php` now parses environment variables (`DB_HOST`, `DB_USER`, `DB_PASSWORD`, `DB_NAME`) with backward-compatible hardcoded defaults.
- **Dynamic Redis Host**: Connection settings in `includes/redis.php` now leverage the `REDIS_HOST` environment variable, defaulting to `127.0.0.1` for traditional deployments.
- **Apache Rewrite Overrides**: Apache is pre-configured in our Docker setup to allow `.htaccess` overrides so that security restrictions (like preventing web access to `/includes`) work perfectly.
