FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    zip unzip curl libzip-dev libpng-dev libonig-dev libpq-dev \
    && docker-php-ext-install zip pdo_pgsql pgsql

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --ignore-platform-req=ext-oci8

# Laravel debe escuchar en el puerto que Render asigna
ENV PORT=10000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=${PORT}"]
