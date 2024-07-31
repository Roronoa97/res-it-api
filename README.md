## About Project

This project is a simple API built with Laravel 11. It provides endpoints for Res-it app - a simple Receipt Management System to store paper receipt.

## Requirements
* php ^8.3
* Composer ^2.5
* postgres ^16

## Installation
> Clone the repository 
```git
git clone https://github.com/Roronoa97/res-it-api.git
```
```git
cd res-it-api
```

> Install dependencies
```git
composer install
```

> Copy the example environment file and make the necessary configuration changes
```git
cp .env.example .env
```

> Generate an application key
```git
php artisan key:generate
```

> Set up your database in the .env file
```git
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

## Database
Run the following command to migrate your database:
> Migration
```git
php artisan migrate
```
> Seeder
```git
php artisan db-see
```

## Running the application
1. Start the local development server:
```git
php artisan serve
```
2. Visit http://localhost:8000 in your browser to access the API

## API Endpoints
* `GET /api/receipts` Get list of receipts
* `POST /api/receipts` Create new receipts
* `GET /api/receipts/{receipt}` Get receipt details
* `PUT /api/receipts/{receipts}` Update receipts
* `DELETE /api/receipts/{receipts}` Delete receipts

## License
This project is licensed under the MIT License.

