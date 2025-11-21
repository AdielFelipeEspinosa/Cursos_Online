FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    zip unzip curl libzip-dev libpng-dev libonig-dev libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql pgsql zip

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copiar composer files
COPY composer.json composer.lock ./

# Instalar dependencias sin scripts
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# Copiar el resto del proyecto
COPY . .

# Ejecutar scripts manualmente ahora que artisan existe
RUN php artisan config:clear || true

ENV PORT=10000

RUN php artisan storage:link || true

CMD php artisan migrate --force && php -S 0.0.0.0:$PORT -t public
