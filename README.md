# BBRSEKP Web Application

Sistem Informasi Desa - BBRSEKP

## Setup

1. Clone repository
2. Copy .env.example menjadi .env
3. Jalankan:

composer install
npm install
php artisan key:generate
php artisan migrate --seed
npm run dev
php artisan storage:link

## Admin Secret Code

Set di .env:
ADMIN_SECRET_CODE=BBRSEKP2026
