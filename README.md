# Laravel E-commerce MVP

E-commerce complet Laravel (MVP) avec:
- Catalogue produits et categories
- Panier et checkout
- Commandes clients
- Paiement PayPal (order + capture + webhook)
- Back-office admin (dashboard, produits, categories, commandes, livraison)
- Emails transactionnels de base

## Installation locale

1. Installer les dependances:
   - `composer install`
2. Configurer l'environnement:
   - copier `.env` et definir DB, mail, app key
3. Lancer les migrations + seed:
   - `php artisan migrate --seed`
4. Lancer l'application:
   - `php artisan serve`

Compte admin seed:
- email: `admin@shop.test`
- password: `password`

## Variables d'environnement importantes

- `APP_URL`
- `DB_*`
- `MAIL_MAILER`, `MAIL_HOST`, `MAIL_PORT`, `MAIL_USERNAME`, `MAIL_PASSWORD`, `MAIL_FROM_ADDRESS`
- `PAYPAL_MODE`
- `PAYPAL_BASE_URL`
- `PAYPAL_CLIENT_ID`
- `PAYPAL_CLIENT_SECRET`
- `PAYPAL_WEBHOOK_ID`
- `PAYPAL_CURRENCY`

## PayPal sandbox/prod

- Sandbox:
  - `PAYPAL_BASE_URL=https://api-m.sandbox.paypal.com`
- Production:
  - `PAYPAL_BASE_URL=https://api-m.paypal.com`
- Configurer le webhook PayPal vers:
  - `https://your-domain.com/api/paypal/webhook`

## Tests

- `php artisan test`

## Deploiement

Voir `DEPLOYMENT.md` et script `scripts/deploy.ps1`.
