# Crear Modelo Vista Controlador
- php artisan make:model ### -cmsr

# Versiones para Oracle y MySQL
- php 8.2
- yajra 12.1.5
- Oracle Client 21_19
- Oracle XE 21_3

# Instalar Bibliotca pra la relacion

- composer require yajra/laravel-oci8
- php artisan session:table

# Instalar Para Migrar de WorkBrench a Laravel
- En WorkBrench Model → Model Options → MySQL y cambia la Target MySQL Version a 5.7 o 5.6.
- composer require --dev kitloong/laravel-migrations-generator
- php artisan migrate:generate 

# Editar Tabla Users
- Se debe cambiar:
- Modelo
- Controlador
- Vista
- php artisan migrate:fresh --seed

# Docker
- RUN composer install --ignore-platform-req=ext-oci8 (Proyecto Simple)

- docker compose build --no-cache
- docker compose up -d

- docker exec -it laravel_app php artisan migrate
- docker exec -it laravel_app php artisan migrate:fresh --seed

- http://localhost:8080/

