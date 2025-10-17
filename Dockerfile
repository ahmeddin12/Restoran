FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git unzip libpng-dev libjpeg-dev libfreetype6-dev libonig-dev libxml2-dev libzip-dev zlib1g-dev \
    curl zip gnupg2 ca-certificates --no-install-recommends

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
 && docker-php-ext-install gd pdo_mysql mbstring exif pcntl bcmath zip

# Enable apache mod_rewrite
RUN a2enmod rewrite

# Copy Composer from official image
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Install Node (optional for frontend build)
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
 && apt-get install -y nodejs

WORKDIR /var/www/html

# Copy composer files first for dependency caching
COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --no-interaction --optimize-autoloader

# Copy rest of the project
COPY . .

# Build frontend assets (if package.json exists)
RUN if [ -f package.json ]; then npm ci && npm run build; fi

# Set proper permissions for Laravel
RUN chown -R www-data:www-data storage bootstrap/cache || true

EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
