# Laravel API with JWT Authentication

A robust Laravel 11 API boilerplate with JWT authentication, comprehensive testing, and detailed documentation.

## Features

- JWT Authentication with php-open-source-saver/jwt-auth
- Rate limiting on authentication endpoints
- RESTful API endpoints
- Comprehensive test suite using Pest PHP
- API documentation with example requests
- Token refresh mechanism
- User profile management
- Environment-based configuration
- Database migrations and seeders
- Authentication error handling

## Requirements

- PHP >= 8.2
- Composer
- SQLite/MySQL/PostgreSQL
- Laravel 11.x

## Installation

1. Clone the repository:
```bash
git clone https://github.com/alphaolomi/laravel-api-jwt.git
cd laravel-api-jwt
```

2. Install dependencies:
```bash
composer install
```

3. Set up environment:
```bash
cp .env.example .env
php artisan key:generate
php artisan jwt:secret
```

4. Configure database in .env:
```
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

5. Run migrations and seeders:
```bash
touch database/database.sqlite
php artisan migrate --seed
```

6. Start the development server:
```bash
php artisan serve
```

## API Endpoints

### Authentication

- `POST /api/auth/login` - Authenticate user and get JWT token
- `POST /api/auth/logout` - Invalidate JWT token
- `POST /api/auth/refresh` - Refresh JWT token
- `POST /api/auth/me` - Get authenticated user profile

For detailed API documentation and examples, see:
- [API Documentation](docs/api.md)
- [API Curl Examples](docs/api-curl.md)

## Testing

The project uses Pest PHP for testing. Run the test suite with:

```bash
composer test
```

Test coverage includes:
- Authentication flows
- Token management
- Protected routes
- Rate limiting
- Error handling

## Security

- JWT token authentication
- Rate limiting on authentication endpoints
- Input validation
- Protected routes middleware
- Token refresh mechanism
- Automatic token invalidation on logout

## Contributing

1. Fork the repository
2. Create a feature branch
3. Commit your changes
4. Push to the branch
5. Create a Pull Request

## License

This project is open-sourced software licensed under the MIT license.

## References

- [Laravel Documentation](https://laravel.com/docs)
- [JWT Auth for Laravel](https://laravel-jwt-auth.readthedocs.io/)
- [JSON Web Tokens](https://jwt.io/)
- [Pest PHP Testing](https://pestphp.com/)
