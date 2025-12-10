#!/bin/sh

set -e

echo "Starting application setup..."

# Create storage directories if they don't exist
mkdir -p /var/www/html/storage/logs
mkdir -p /var/www/html/storage/framework/cache/data
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
    php artisan storage:link || true
fi

# Clear and rebuild all caches for optimal performance
echo "Optimizing application..."
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# Rebuild caches
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Optimize autoloader
composer dump-autoload --optimize --no-dev --classmap-authoritative 2>/dev/null || true

echo "Application optimized successfully!"

# Run migrations (optional, can be removed if you want to run manually)
if [ "$RUN_MIGRATIONS" = "true" ]; then
    echo "Running migrations..."
    php artisan migrate --force
fi

echo "Starting services..."

# Execute the main command
exec "$@"
