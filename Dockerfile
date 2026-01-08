FROM php:8.2-apache

# Installazione dipendenze di sistema, Node.js e librerie Postgres
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libpq-dev \
    zip \
    unzip \
    git \
    && curl -sL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql pdo_pgsql

# Abilita mod_rewrite per Laravel
RUN a2enmod rewrite

# Installa Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

# Installazione dipendenze PHP e JS
RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

# Gestione Storage Link (evita l'errore Permission Denied)
RUN rm -rf public/storage && ln -s /var/www/html/storage/app/public /var/www/html/public/storage

# Permessi corretti per l'utente web di Apache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public/storage

# Configurazione Apache per puntare a /public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

EXPOSE 80

# Avvia solo il server Apache
CMD ["apache2-foreground"]
