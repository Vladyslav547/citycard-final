# CityCard – Laravel CRUD App

A small Laravel application to manage transit cards, cities, transport types, ticket types, top-ups and rides.  
Supports user authentication (email/password) and an admin panel.

## Features

- User authentication and registration
- User dashboard with:
  - List of own cards
  - Balance
  - Top-up history
  - Rides history
- Admin panel with management of:
  - Cities
  - Transport Types
  - Ticket Types and Prices
  - Users (view and delete)
- Clean codebase with English comments
- Validation using Form Requests
- Seeders included (admin user, transport types)

## Tech Stack

- PHP 8.2+
- Laravel 10
- MySQL or MariaDB
- Composer & Artisan
- Bootstrap 5 (Blade templates)
- Vite (for assets)

## Installation

```bash
git clone https://github.com/Vladyslav547/citycard-final.git
cd citycard-final

cp .env.example .env
# Configure DB_* credentials in .env

composer install
php artisan key:generate
php artisan migrate --seed

npm install
npm run build

php artisan serve

# App runs at http://127.0.0.1:8000
