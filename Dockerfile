FROM php:8.2-fpm

# Extensiones necesarias para Laravel
RUN apt-get update && apt-get install -y \
    zip unzip curl libzip-dev libpng-dev libonig-dev \
    && docker-php-ext-install pdo_mysql zip

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copia todos los archivos de Laravel
COPY . .

# Instala dependencias de Laravel
RUN composer install --ignore-platform-req=ext-oci8


CMD ["php-fpm"]
