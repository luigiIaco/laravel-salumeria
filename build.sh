#!/usr/bin/env bash
# Esci immediatamente se un comando fallisce
set -o errexit

composer install --no-dev --optimize-autoloader

# Installa le dipendenze JS e compila i file (Vite)
npm install
npm run build

# Pulisci le cache
php artisan config:cache
php artisan route:cache
php artisan view:cache
