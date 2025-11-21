# Imagen base PHP 8.2 con FPM
FROM php:8.2-cli

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    zip unzip curl libzip-dev libpng-dev libonig-dev libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql pgsql zip

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Establecer directorio del proyecto
WORKDIR /var/www/html

# Copiar solo composer.json y composer.lock para cacheo
COPY composer.json composer.lock ./

# Instalar dependencias (cache)
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Copiar el resto del proyecto
COPY . .

# Exponer puerto que Render asigna dinámicamente
ENV PORT=10000

# Generar storage link (por si usas imágenes)
RUN php artisan storage:link || true

# Comando final:
# 1. Ejecuta migraciones
# 2. Inicia el servidor PHP apuntando a /public
CMD php artisan migrate --force && php -S 0.0.0.0:$PORT -t public
