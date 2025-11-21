FROM php:8.2-fpm

# Dependencias necesarias para Laravel + PostgreSQL
RUN apt-get update && apt-get install -y \
    zip unzip curl libzip-dev libpng-dev libonig-dev libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql pgsql zip

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copiar código del proyecto
COPY . .

# Instalar dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Puerto que Render expone
ENV PORT=10000

# Comando para iniciar Laravel
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=$PORT

