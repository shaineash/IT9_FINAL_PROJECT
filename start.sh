#!/bin/bash
set -e

# Run migrations at runtime (DB is ready by this point)
php artisan migrate --force

# Clear and cache config for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start Apache
exec apache2-foreground
