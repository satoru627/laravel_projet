$ErrorActionPreference = "Stop"

Write-Host "Installing dependencies..."
composer install --no-dev --optimize-autoloader

Write-Host "Preparing application..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

Write-Host "Running migrations..."
php artisan migrate --force

Write-Host "Deployment completed."
