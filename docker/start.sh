#!/bin/sh
set -e

# Ensure storage directory structure exists (needed when Railway volume is mounted fresh)
mkdir -p /var/www/html/storage/app/public
mkdir -p /var/www/html/storage/framework/cache/data
mkdir -p /var/www/html/storage/framework/sessions
mkdir -p /var/www/html/storage/framework/testing
mkdir -p /var/www/html/storage/framework/views
mkdir -p /var/www/html/storage/logs

# Fix ownership
chown -R www-data:www-data /var/www/html/storage
chmod -R 775 /var/www/html/storage

# Create storage symlink (public/storage -> storage/app/public)
rm -f /var/www/html/public/storage
ln -sf /var/www/html/storage/app/public /var/www/html/public/storage

# Run migrations if needed
php artisan migrate --force 2>/dev/null || true

# Start supervisord
exec /usr/bin/supervisord -c /etc/supervisord.conf
