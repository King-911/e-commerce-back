FROM php:8.2-apache

# Instalar dependencias del sistema y extensiones de PHP necesarias para Laravel y PostgreSQL
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    zip \
    unzip

RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd

# Habilitar mod_rewrite de Apache
RUN a2enmod rewrite

# Copiar Composer desde su imagen oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar directorio de trabajo
WORKDIR /var/www/html

# Copiar el código del proyecto
COPY . /var/www/html

# Dar permisos a las carpetas de storage y bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Cambiar el document root de Apache a la carpeta public de Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -s -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -s -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# Instalar dependencias de composer para producción
RUN composer install --no-dev --optimize-autoloader

# Exponer el puerto
EXPOSE 80