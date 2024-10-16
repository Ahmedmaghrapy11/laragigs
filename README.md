# Laragigs - Job Listings Platform

## Introduction
**Laragigs** is a project developed for learning **Laravel**. It implements a full CRUD functionality for job listings, email-based user authentication, and user authorization. The project also includes a user dashboard for managing job posts. Built using **Laravel** for back-end with **MySQL** for data storage and The front-end design is styled using **Tailwind CSS**.

## Technologies
- **PHP**: ^8.1
- **Laravel**: ^10.0
- **MySQL**: 8.x.x
- **Tailwind CSS**: 3.4.13
- **Composer**: Dependency management for PHP

## Features
- **Job CRUD Operations**: Users can create, read, update, and delete job listings.
- **User Authentication**: Secure email-based registration and login functionality.
- **User Dashboard**: Authenticated users can manage their job listings from a personal dashboard.
- **Authorization**: Users can only edit or delete jobs they posted.
- **Tailwind CSS**: Responsive and modern front-end design.

## Setup

### 1. Clone the Repository
To start, clone this repository to your local machine:
```bash
git clone https://github.com/yourusername/laragigs.git
cd laragigs
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Set Up Environment Variables
- Create a .env file by copying .env.example:
```bash
cp .env.example .env
```
- Update the following database-related settings in the .env file to match your MySQL setup:
```code
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laragigs_db
DB_USERNAME=your_mysql_username
DB_PASSWORD=your_mysql_password
```
### 4. Create Database in MySQL
```sql
CREATE DATABASE laragigs_db;
```

### 5. Generate Application Key
```bash
php artisan key:generate
```

### 6. Run Migrations
```bash
php artisan migrate
```

### 7. Run the Development Server
```bash
php artisan serve
```
