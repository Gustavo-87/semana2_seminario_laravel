#!/bin/sh
set -e

echo "Ajustando permisos de almacenamiento..."
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

if [ -n "$DATABASE_URL" ]; then
    echo "DATABASE_URL detectada: $(echo $DATABASE_URL | sed 's/:[^:]*@/:***@/')"
else
    echo "ADVERTENCIA: DATABASE_URL no está definida."
fi

php artisan config:cache
php artisan route:cache
php artisan view:cache

php artisan storage:link --force || true

echo "Ejecutando migraciones de base de datos..."
php artisan migrate --force

php-fpm -D

echo "Iniciando Nginx..."
nginx -g 'daemon off;'
