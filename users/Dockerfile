# Users Microservice Dockerfile
FROM php:8.1-fpm

WORKDIR /var/www/users

# Install system dependencies
RUN apt-get update \
    && apt-get install -y \
        git \
        unzip \
        libzip-dev \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql zip

# Install Redis extension
RUN pecl install redis && docker-php-ext-enable redis

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set COMPOSER_ALLOW_SUPERUSER to true during the build process
ARG COMPOSER_ALLOW_SUPERUSER=1

# Copy composer.json and composer.lock
COPY users/composer.json users/composer.lock ./

# Install project dependencies
RUN COMPOSER_ALLOW_SUPERUSER=$COMPOSER_ALLOW_SUPERUSER composer install --no-scripts --no-autoloader

# Copy the entire application
COPY users .

# Generate optimized Composer autoloader
RUN composer dump-autoload --optimize --no-scripts

# Configure PHP-FPM to listen on TCP socket instead of Unix socket
RUN echo "listen = 3000" > /usr/local/etc/php-fpm.d/zz-docker.conf

# Expose port 3000 and start php-fpm server
EXPOSE 3000
ENTRYPOINT ["php-fpm"]