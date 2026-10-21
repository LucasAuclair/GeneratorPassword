FROM php:8.4-apache


# Activation du module de réécriture d'URL de Laravel
RUN a2enmod rewrite

# Installation des dépendances et de Composer
RUN apt-get update && apt-get install -y unzip git libpng-dev libjpeg-dev \
    && docker-php-ext-install gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copie du projet dans le dossier du serveur Apache
COPY . /var/www/html

# Configuration du dossier racine sur /public pour Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# Installation des dépendances PHP de production
RUN composer install --no-dev --optimize-autoloader

# Permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80
