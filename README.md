# CityCard – Public Transport Card Demo (Laravel)

CityCard is a demo Laravel application for managing public transport cards.  
Users can create cards, top up balance, and record rides.  
Admins can manage master data (cities, ticket types) and review users.

---

## Features

- **Auth**
  - Email + password login (users & admins)
  - Card-number login (separate screen) for users
- **Users**
  - Own multiple cards
  - See card balance
  - Top-up history & ride history
- **Admins**
  - Manage **Cities**
  - Manage **Ticket Types** (per city)
  - Review and delete **Users**
- **Relationships**
  - Cities ↔ Transport Types (many-to-many)
  - Ticket Types belong to a City
  - Card has Recharges and Rides

---

## Tech Stack

- Laravel (PHP)
- MySQL (or compatible) / SQLite
- Bootstrap (via Laravel Breeze/UI scaffolding)
- Blade templates

---

## Requirements

- PHP 8.1+ (or the version required by your Laravel)
- Composer
- MySQL/MariaDB (or SQLite for local)
- Node.js + npm (for assets if needed)

---

## Getting Started

```bash
# 1) Clone
git clone https://github.com/<your-account>/citycard.git
cd citycard

# 2) Install dependencies
composer install
npm install    # optional if you need to build assets
npm run build  # or: npm run dev

# 3) Copy environment & set app key
cp .env.example .env
php artisan key:generate

# 4) Configure .env (DB_*, MAIL_*, etc.)
# Example (MySQL):
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=citycard
# DB_USERNAME=root
# DB_PASSWORD=secret

# 5) Run migrations (and seed if you have seeders)
php artisan migrate
# php artisan db:seed   # only if you created seeders

# 6) Serve the app
php artisan serve
# App will be available at http://127.0.0.1:8000
