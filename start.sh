#!/bin/bash

echo "=== Starting Laravel Application ==="

# Clear caches
echo "=== Clearing Caches ==="
php artisan config:clear
php artisan cache:clear

# Wait for database connection
echo "=== Waiting for Database Connection ==="
sleep 10

# Check database connection
echo "=== Database Connection Test ==="
php artisan migrate:status

# Run migrations
echo "=== Running Migration ==="
php artisan migrate:fresh --force

# Check migration status
echo "=== Migration Complete ==="
php artisan migrate:status

# Run seeders
echo "=== Running Seeder ==="
php artisan db:seed --force

# Start server
echo "=== Starting Server ==="
exec php -S 0.0.0.0:8000 -t public
