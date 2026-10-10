#!/bin/bash
set -e

# Run database migrations on startup
php artisan migrate --force || true

# Ensure storage directories exist and symlink is linked
mkdir -p /var/www/html/storage/app/public/authorization_letters
mkdir -p /var/www/html/storage/app/public/authorized_ids
mkdir -p /var/www/html/storage/app/public/voter_ids
mkdir -p /var/www/html/storage/app/public/guest_ids
mkdir -p /var/www/html/storage/app/public/pet_vaccine_proofs
rm -rf /var/www/html/public/storage || true
php artisan storage:link || true

# Start apache
exec apache2-foreground
