# Saku Planner API

A Laravel-based REST API for personal financial planning and budget management. This application helps users track their income, expenses, budgets, and financial goals.

## Features

- **User Authentication**: Secure user registration and login with Laravel Sanctum
- **Budget Management**: Create and manage budgets with category-based tracking
- **Transaction Tracking**: Record and categorize income and expenses
- **Account Management**: Manage multiple financial accounts (wallets)
- **Categories**: Organize transactions with custom categories
- **Monthly Budget Tracking**: Monitor budget performance over time
- **Financial Targets**: Set and track financial goals
- **Data Synchronization**: Sync data across devices
- **Device Detection**: Track user devices for security purposes

## Technology Stack

- **Backend**: Laravel 12.x
- **Database**: PostgreSQL
- **Authentication**: Laravel Sanctum
- **PHP Version**: 8.2+
- **Frontend Build**: Vite with TailwindCSS
- **Testing**: Pest PHP
- **Monitoring**: Laravel Telescope

## API Endpoints

### Authentication
- `POST /api/auth/register` - User registration
- `POST /api/auth/login` - User login
- `GET /api/auth/me` - Get current user profile
- `POST /api/auth/update` - Update user profile
- `POST /api/auth/logout` - User logout

### Data Synchronization
- `GET /api/sync` - Get synchronization data
- `POST /api/sync` - Synchronize data

## Requirements

- PHP 8.2 or higher
- Composer
- Node.js 18+ and npm
- PostgreSQL
- Git

## Installation

### 1. Clone the Repository

```bash
git clone https://github.com/dzackiero/saku-planner-api.git
cd saku-planner-api
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Node.js Dependencies

```bash
npm install
```

### 4. Environment Setup

Copy the example environment file and configure it:

```bash
cp .env.example .env
```

### 5. Configure Database

Edit the `.env` file with your database settings:

```env
DB_CONNECTION=pgsql
DB_HOST=localhost
DB_PORT=5432
DB_DATABASE=saku_planner_api
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 6. Generate Application Key

```bash
php artisan key:generate
```

### 7. Run Database Migrations

```bash
php artisan migrate
```

### 8. (Optional) Seed Database

```bash
php artisan db:seed
```

### 9. Build Frontend Assets

```bash
npm run build
```

## Development

### Running the Development Server

To start the development environment with all services:

```bash
composer dev
```

This command runs:
- Laravel development server
- Queue worker
- Vite development server

Or run services individually:

```bash
# Start Laravel server
php artisan serve

# Start queue worker
php artisan queue:work

# Start Vite dev server
npm run dev
```

### Testing

Run the test suite using Pest:

```bash
# Run all tests
php artisan test

# Run specific test file
php artisan test tests/Feature/AuthTest.php

# Run tests with coverage
php artisan test --coverage
```

### Code Quality

Format code using Laravel Pint:

```bash
./vendor/bin/pint
```

### Database

#### Migrations

Create a new migration:

```bash
php artisan make:migration create_table_name
```

Run migrations:

```bash
php artisan migrate
```

#### Seeders

Create a new seeder:

```bash
php artisan make:seeder TableNameSeeder
```

Run seeders:

```bash
php artisan db:seed
```

### Monitoring

Access Laravel Telescope for debugging and monitoring:

```
http://localhost:8000/telescope
```

## Configuration

### Key Configuration Files

- `.env` - Environment variables
- `config/app.php` - Application settings
- `config/database.php` - Database configuration
- `config/sanctum.php` - API authentication settings

### Important Environment Variables

```env
APP_NAME=Saku Planner API
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=pgsql
DB_HOST=localhost
DB_PORT=5432
DB_DATABASE=saku_planner_api

MAIL_MAILER=log
QUEUE_CONNECTION=database
CACHE_STORE=database
```

## Deployment

### Production Setup

1. Set environment to production:
   ```env
   APP_ENV=production
   APP_DEBUG=false
   ```

2. Optimize application:
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   composer install --optimize-autoloader --no-dev
   ```

3. Set up proper web server configuration (Nginx/Apache)

4. Configure SSL certificates

5. Set up proper queue processing (supervisor)

## Project Structure

```
app/
├── Http/Controllers/     # API controllers
├── Models/              # Eloquent models
├── Services/            # Business logic services
├── Data/               # Data transfer objects
└── Helpers/            # Helper functions

database/
├── migrations/         # Database migrations
├── seeders/           # Database seeders
└── factories/         # Model factories

tests/
├── Feature/           # Feature tests
└── Unit/             # Unit tests
```

## Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Support

For support, please create an issue in the GitHub repository or contact the development team.
