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

# Abilita mod_rewrite per Laravel (indispensabile per le rotte)
RUN a2enmod rewrite

# Installa Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

# Installazione dipendenze PHP
RUN composer install --no-dev --optimize-autoloader

# Installazione dipendenze JS e compilazione asset (Vite)
RUN npm install && npm run build

# Permessi corretti per le cartelle di Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Configurazione Apache per puntare a /public invece della root
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

EXPOSE 80

# Esegue le migrazioni e avvia Apache
# Il flag --force è fondamentale per eseguire migrazioni in produzione
CMD php artisan migrate --force && apache2-foreground
