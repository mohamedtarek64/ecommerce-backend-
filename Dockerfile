# Use PHP 8.1
FROM php:8.1-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libwebp-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy composer files
COPY composer.json composer.lock ./

# Install dependencies
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Copy application code
COPY . .

# Create necessary directories
RUN mkdir -p storage/logs \
    && mkdir -p storage/framework/cache \
    && mkdir -p storage/framework/sessions \
    && mkdir -p storage/framework/views \
    && mkdir -p bootstrap/cache

# Set permissions
RUN chmod -R 777 storage bootstrap/cache

# Clear caches
RUN php artisan config:clear \
    && php artisan cache:clear \
    && php artisan route:clear \
    && php artisan view:clear

# Expose port
EXPOSE 8000

# Start command with migration and seeding
CMD php artisan config:clear && php artisan cache:clear && echo "=== Starting Migration Process ===" && sleep 10 && echo "=== Database Connection Test ===" && php artisan migrate:status && echo "=== Running Migration ===" && php artisan migrate:fresh --force && echo "=== Migration Complete ===" && php artisan migrate:status && echo "=== Running Seeder ===" && php artisan db:seed --force && echo "=== Starting Server ===" && exec php -S 0.0.0.0:8000 -t public
