# User FrankenPHP image
FROM dunglas/frankenphp:latest

# Set working directory
WORKDIR /app

# Copy all project file
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

# Permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Expose port
EXPOSE 8000
