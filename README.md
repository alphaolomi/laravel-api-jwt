# Laravel API with JWT Authentication

## Description

-   Laravel 11
-   JWT Authentication
-   API Resource
-   Pest PHP Testing

## Installation

```bash
git clone
composer install
cp .env.example .env
php artisan key:generate
php artisan jwt:secret
php artisan migrate
php artisan db:seed
php artisan serve
```

## Testing

Using Pest PHP Testing

```bash
composer test
```

## Reference

-   [Laravel JWT Auth Docs](https://laravel-jwt-auth.readthedocs.io/en/stable/resources/)
-   [The Anatomy of a JSON Web Token](https://scotch.io/tutorials/the-anatomy-of-a-json-web-token)
-   [jwt.io](https://jwt.io/)
