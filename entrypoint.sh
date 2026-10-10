#!/bin/bash
set -e

# Run database migrations on startup
php artisan migrate --force || true

# Start apache
exec apache2-foreground
