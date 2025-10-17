FROM php:8.2-apache

# system deps
RUN apt-get update && apt-get install -y \
    git unzip libpng-dev libonig-dev libxml2-dev libzip-dev zlib1g-dev \
    curl zip gnupg2 ca-certificates --no-install-recommends

# PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath zip
RUN docker-php-ext-configure gd --with-jpeg && docker-php-ext-install gd

# Enable apache mod_rewrite
RUN a2enmod rewrite

# Install Composer (copy from official composer image)
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Install Node (for optional frontend build)
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
 && apt-get install -y nodejs

WORKDIR /var/www/html

# Copy composer files first for caching
COPY composer.json composer.lock /var/www/html/
RUN composer install --no-dev --prefer-dist --no-interaction --optimize-autoloader

# Copy project
COPY . /var/www/html

# If package.json exists, build front-end assets
RUN if [ -f package.json ]; then npm ci && npm run build; fi

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache || true

EXPOSE 80

# Recommended: set environment variables in Render dashboard (do not bake APP_KEY here)
CMD ["apache2-foreground"]