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
mkdir -p /var/www/html/storage/app/public/pet_photos
mkdir -p /var/www/html/storage/app/public/residents/photos
mkdir -p /var/www/html/storage/app/public/profile_photos
mkdir -p /var/www/html/storage/app/public/issue_evidence
mkdir -p /var/www/html/storage/app/public/proofs/senior
mkdir -p /var/www/html/storage/app/public/proofs/pwd
mkdir -p /var/www/html/storage/app/public/proofs/bedridden
rm -rf /var/www/html/public/storage || true
php artisan storage:link || true

# Set storage ownership and permissions for web server
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public || true
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache || true

# Start apache
exec apache2-foreground
