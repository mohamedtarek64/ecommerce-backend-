# Use PHP 8.2 Alpine image
FROM php:8.2-fpm-alpine

# Install system dependencies
RUN apk add --no-cache \
    git \
    curl \
    libpng-dev \
    libxml2-dev \
    zip \
    unzip \
    mysql-client \
    nodejs \
    npm

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy composer files
COPY composer.json composer.lock ./

# Install dependencies (without dev dependencies for production)
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Copy application code
COPY . .

# Set permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage \
    && chmod -R 755 /var/www/bootstrap/cache

# Generate application key if not exists
RUN php artisan key:generate --force || true

# Cache configuration (skip if collision not available)
RUN php artisan config:cache || echo "Config cache skipped" \
    && php artisan route:cache || echo "Route cache skipped" \
    && php artisan view:cache || echo "View cache skipped"

# Expose port
EXPOSE 8000

# Start the application
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
