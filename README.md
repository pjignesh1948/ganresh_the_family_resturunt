# Ganesh The Family Restaurant

Website and admin panel for **Ganesh The Family Restaurant** — menu, online orders, vegetable pricing, staff & salary, gallery, videos, portfolio, and SOP management.

## Requirements

- PHP 8.2+
- Composer
- MySQL or SQLite

**No Docker required.**

## Setup

```bash
cd ganesh-restaurant
composer install
cp .env.example .env
php artisan key:generate
```

### Database (SQLite — easiest for local)

In `.env`:

```
DB_CONNECTION=sqlite
```

Comment out `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`.

Then:

```bash
touch database/database.sqlite
php artisan migrate
php artisan db:seed
php artisan storage:link
php artisan serve
```

Open:
- **Website:** http://127.0.0.1:8000
- **Admin:** http://127.0.0.1:8000/admin/login

**Default admin login:**
- Email: `admin@ganeshtfr.com`
- Password: `admin123`

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
