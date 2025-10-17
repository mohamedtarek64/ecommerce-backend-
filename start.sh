#!/bin/bash
set -e

echo "=== Clearing Caches ==="
php artisan config:clear
php artisan cache:clear

echo "=== Waiting for Database ==="
sleep 10

echo "=== Database Connection Test ==="
php artisan migrate:status || true

echo "=== Running Migration ==="
php artisan migrate:fresh --force

echo "=== Migration Complete ==="
php artisan migrate:status

echo "=== Running Seeder ==="
php artisan db:seed --force

echo "=== Seeding Complete ==="

echo "=== Starting Export ==="
php export_railway_data.php

echo "=== Export Complete ==="

echo "=== Starting Server ==="
exec php artisan serve --host=0.0.0.0 --port=$PORT
