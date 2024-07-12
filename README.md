## Chirper App Demo

This is the end result of the Laravel Bootcamp's "Blade with Alpine" track for demo purposes.

### Setup

```bash
git clone git@github.com:tonysm/laravel-bootcamp-blade-chirper.git chirper
cd chirper/
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate
npm install && npm run build
```

