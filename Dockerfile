FROM php:8.2-apache

# Instalar extensiones de PHP necesarias
RUN apt-get update && apt-get install -y \
    libzip-dev unzip git curl \
    && docker-php-ext-install pdo pdo_mysql zip

# Habilitar mod_rewrite para Laravel
RUN a2enmod rewrite

# Establecer configuración para que Laravel funcione correctamente
COPY . /var/www/laravel

WORKDIR /var/www/laravel

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Copiar archivos públicos a la raíz del servidor
RUN rm -rf /var/www/html \
    && ln -s /var/www/laravel/public /var/www/html

# Dar permisos adecuados
RUN chown -R www-data:www-data /var/www/laravel/storage /var/www/laravel/bootstrap/cache

EXPOSE 80
