# Stage 1: Build PHP dependencies
FROM composer:2.7 AS vendor
WORKDIR /app
COPY composer.json composer.lock ./
# Ignore platform reqs to avoid missing extension errors during build
RUN composer install --no-dev --no-interaction --prefer-dist --ignore-platform-reqs --no-scripts
COPY . .
RUN composer dump-autoload --optimize --no-dev --classmap-authoritative

# Stage 2: Build Node.js assets
FROM node:20-alpine AS frontend
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# Stage 3: Production Runtime
FROM php:8.3-fpm-alpine

# Set non-root user id from host (www-data is usually 82 on alpine)
# Install PHP extensions
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions pdo_mysql pdo_pgsql bcmath opcache zip intl gd pcntl redis

# Install Nginx and Supervisor
RUN apk add --no-cache nginx supervisor && \
    rm -rf /var/cache/apk/* && \
    mkdir -p /var/log/supervisor

WORKDIR /var/www/html

# Copy built files
COPY --from=vendor /app /var/www/html
COPY --from=frontend /app/public/build /var/www/html/public/build

# Setup Nginx
COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/default.conf /etc/nginx/http.d/default.conf

# Setup Supervisor
COPY docker/supervisord.conf /etc/supervisord.conf

# Permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port
EXPOSE 80

# Start supervisor
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]
