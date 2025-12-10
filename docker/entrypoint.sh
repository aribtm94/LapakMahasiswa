#!/bin/sh

set -e

# Create storage directories if they don't exist
mkdir -p /var/www/html/storage/logs
mkdir -p /var/www/html/storage/framework/cache
mkdir -p /var/www/html/storage/framework/sessions
mkdir -p /var/www/html/storage/framework/views
mkdir -p /var/www/html/bootstrap/cache

# Set permissions
chown -R www-data:www-data /var/www/html/storage
chown -R www-data:www-data /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage
chmod -R 775 /var/www/html/bootstrap/cache

# Create storage symlink if it doesn't exist
if [ ! -L /var/www/html/public/storage ]; then
    php artisan storage:link
fi

# Cache configuration for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations (optional, can be removed if you want to run manually)
if [ "$RUN_MIGRATIONS" = "true" ]; then
    php artisan migrate --force
fi

# Execute the main command
exec "$@"
