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

# Copy composer files for caching
COPY composer.json composer.lock ./

# Install dependencies without running post-autoload scripts
RUN composer install --no-dev --prefer-dist --no-interaction --optimize-autoloader --no-scripts

# Copy full project
COPY . .

# Run artisan commands now that files exist
RUN php artisan config:clear
RUN php artisan route:cache

# Continue with Node build and permissions...

# Build frontend assets (if package.json exists)
RUN if [ -f package.json ]; then npm ci && npm run build; fi

# Set proper permissions for Laravel
RUN chown -R www-data:www-data storage bootstrap/cache || true

EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
