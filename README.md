# LaravelOne
1st project of laravel
# E-commerce Product Management System

## Overview
This is an E-commerce Product Management System built using Laravel. The application allows users to manage products and categories efficiently, providing functionalities to create, read, update, and delete (CRUD) products and categories.

## Features
- User authentication and authorization
- Manage products:
  - Create new products
  - View a list of products
  - Edit existing products
  - Delete products
  - Filter products by category
  - Pagination for product listing
- Manage categories:
  - Create new categories
  - View a list of categories
  - Edit existing categories
  - Delete categories

## Prerequisites
- PHP >= 7.3
- Composer
- MySQL or any supported database
- Laravel 8.x or later

## Setup Instructions

### 1. Clone the Repository
```bash
git clone https://github.com/IT21247804/LaravelOne.git
cd LaravelOne
```

### 2. Install dependencies
```bash
composer install
```
### 3. Configure Environment Variables
```bash
cp .env.example .env
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 4. Generate Application Key
```bash
php artisan key:generate
```

### 5. Migrate the Database
```bash
php artisan migrate
```
### 6. Start the Development Server
```bash
php artisan serve
```

### You can access the application at http://localhost:8000.
