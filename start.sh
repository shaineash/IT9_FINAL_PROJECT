#!/bin/bash
set -e

# Run migrations
php artisan migrate --force

# Seed the admin user (safe — uses firstOrCreate, won't duplicate)
php artisan db:seed --class=AdminUserSeeder --force

# Cache config/routes/views for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start Apache
exec apache2-foreground
