#!/bin/sh
set -e

cp .env.example .env
php artisan key:generate --ansi

php artisan migrate --ansi

chown -R www-data:www-data /var/www/storage
chown -R www-data:www-data /var/www/bootstrap/cache

exec php-fpm
