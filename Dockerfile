FROM php:8.2-apache

# Instalamos la extensión de PostgreSQL para Supabase
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Copiamos tu código al servidor
COPY . /var/www/html/

# Habilitamos el módulo de reescritura si lo necesitas
RUN a2enmod rewrite

EXPOSE 80
