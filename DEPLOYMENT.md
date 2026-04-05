# Deployment Checklist

## Pre-deploy
- Configure `.env` with database, mail and PayPal credentials.
- Set `APP_ENV=production` and `APP_DEBUG=false`.
- Ensure queue worker and scheduler are configured.

## Commands
- `composer install --no-dev --optimize-autoloader`
- `php artisan migrate --force`
- `php artisan config:cache`
- `php artisan route:cache`
- `php artisan view:cache`

## Services
- Start queue worker: `php artisan queue:work --tries=3`
- Configure cron to run: `php artisan schedule:run` every minute.

## PayPal
- Use sandbox for tests (`PAYPAL_BASE_URL=https://api-m.sandbox.paypal.com`).
- Configure production endpoint and webhook in PayPal dashboard.
- Point webhook URL to `/api/paypal/webhook`.
