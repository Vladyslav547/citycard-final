# CityCard – Laravel CRUD app

A small Laravel app to manage transit cards, cities, transport types, ticket types, top-ups and rides.  
Supports basic user authentication (email + password) and an admin area.

## Features
- User auth (email + password), registration.
- User dashboard: own cards, balance, top-up history, rides history.
- Admin: CRUD for Cities, Ticket Types, Transport Types; Users list with delete-only.
- Clean structure, English comments, FormRequest-based validation (post-refactor).

## Tech Stack
- PHP 8.2+, Laravel 10+
- MySQL / MariaDB
- Bootstrap 5 (Blade views)
- Composer, Artisan

## Getting Started
```bash
git clone https://github.com/<your-username>/citycard.git
cd citycard

cp .env.example .env
# Set DB_* credentials in .env

composer install
php artisan key:generate
php artisan migrate --seed

php artisan serve
# App runs at http://127.0.0.1:8000
