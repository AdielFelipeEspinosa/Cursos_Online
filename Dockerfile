FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    zip unzip curl libzip-dev libpng-dev libonig-dev \
    libpq-dev \
    && docker-php-ext-install pdo_mysql zip \
    && docker-php-ext-install pgsql pdo_pgsql

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --ignore-platform-req=ext-oci8

CMD ["php-fpm"]
