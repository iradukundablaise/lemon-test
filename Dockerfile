# Use PHP 8.4 CLI image
FROM php:8.4-cli

# Set working directory
WORKDIR /var/www/html

# Install system dependencies for composer and PHP extensions if needed
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libzip-dev \
    && docker-php-ext-install zip \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application files
COPY . .

# Install PHP dependencies
RUN composer install --no-interaction --optimize-autoloader

# Expose port 8000 for PHP built-in server
EXPOSE 8000

# Run PHP built-in server serving the public folder
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
