# Gunakan image FrankenPHP resmi
FROM dunglas/frankenphp:latest

# Set working directory
WORKDIR /app

# Copy seluruh project
COPY . /app

# Install PHP extensions
RUN apt update && apt install -y \
        zip \
        libzip-dev \
        libicu-dev \
        libpq-dev \
    && docker-php-ext-install \
        zip \
        intl \
        pcntl \
        pdo_pgsql \
    && docker-php-ext-enable zip intl pcntl pdo_pgsql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install dependencies
RUN composer install

# Pastikan permission storage & bootstrap/cache
RUN chown -R www-data:www-data storage bootstrap/cache

# Expose port FrankenPHP
EXPOSE 8080
