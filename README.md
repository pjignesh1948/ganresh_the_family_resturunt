# Ganesh The Family Restaurant

Website and admin panel for **Ganesh The Family Restaurant** — menu, online orders, vegetable pricing, staff & salary, gallery, videos, portfolio, and SOP management.

## Requirements

- PHP 8.2+
- Composer
- MySQL 8.0+ (or MariaDB)

**No Docker required.**

## Setup

```bash
cd ganesh-restaurant
composer install
cp .env.example .env
php artisan key:generate
```

### Database (MySQL)

1. Start MySQL and create/import the database:

```bash
mysql -u root -p < database/ganesh_restaurant_mysql.sql
```

Or create manually then import:

```bash
mysql -u root -p -e "CREATE DATABASE ganesh_restaurant CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
mysql -u root -p ganesh_restaurant < database/ganesh_restaurant_mysql.sql
```

2. Configure `.env`:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ganesh_restaurant
DB_USERNAME=root
DB_PASSWORD=your_password
```

3. Run the app:

```bash
php artisan storage:link
php artisan serve
```

Open:
- **Website:** http://127.0.0.1:8000
- **Admin:** http://127.0.0.1:8000/admin/login

**Default admin login:**
- Email: `admin@ganeshtfr.com`
- Password: `admin123`

### Fresh install (empty database)

If you prefer migrations + seed instead of importing the SQL dump:

```bash
php artisan migrate
php artisan db:seed
```

### Re-export MySQL SQL from legacy SQLite file

If you still have `database/database.sqlite`:

```bash
php database/convert_sqlite_to_mysql.php
```

This regenerates `database/ganesh_restaurant_mysql.sql`.

### SMS (when you purchase)

Add to `.env`:
```
SMS_ENABLED=true
SMS_API_KEY=your_key_here
SMS_ADMIN_PHONE=9276819283
```

### Mail (order notifications)

Configure mail in `.env`. Set order notify email in Admin → Settings.

## Modules

| Module | Admin | Front |
|--------|-------|-------|
| Menu | CRUD + images | Online order |
| Vegetables | CRUD + price logs | Weight calculator |
| Staff & salary | CRUD + advances | — |
| Gallery / Videos / Portfolio | CRUD | Public pages |
| SOPs | CRUD | — |
| Settings & pages | Dynamic content | Home, About, Contact |

## Logo

`public/images/logo.png`
