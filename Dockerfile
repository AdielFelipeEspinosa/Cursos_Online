FROM php:8.2-fpm

# Dependencias PHP
RUN apt-get update && apt-get install -y \
    zip unzip curl gnupg2 apt-transport-https \
    libzip-dev libpng-dev libonig-dev libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql pgsql zip

# Instalar Caddy (método moderno sin apt-key)
RUN curl -1sLf 'https://dl.cloudsmith.io/public/caddy/stable/gpg.key' \
    | gpg --dearmor -o /usr/share/keyrings/caddy.gpg \
    && curl -1sLf 'https://dl.cloudsmith.io/public/caddy/stable/debian.deb.txt' \
    | sed 's#deb #deb [signed-by=/usr/share/keyrings/caddy.gpg] #' \
    | tee /etc/apt/sources.list.d/caddy-stable.list \
    && apt-get update \
    && apt-get install -y caddy

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader

COPY Caddyfile /etc/caddy/Caddyfile

ENV PORT=10000

CMD php artisan migrate --force && caddy run --config /etc/caddy/Caddyfile
