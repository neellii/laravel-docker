# Laravel Docker E-commerce

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Laravel Docker Starter Kit

-   Laravel v11.x
-   PHP v8.3.x
-   MySQL v8.1.x (default)
-   phpMyAdmin v5.x
-   Mailpit v1.x
-   Node.js v18.x
-   NPM v10.x
-   Yarn v1.x
-   Vite v5.x
-   Rector v1.x
-   Redis v7.2.x

# Requirements

-   Stable version of [Docker](https://docs.docker.com/engine/install/)
-   Compatible version of [Docker Compose](https://docs.docker.com/compose/install/#install-compose)

# Setup

### For first time only !

-   `git clone https://github.com/refactorian/laravel-docker.git`
-   `cd laravel-docker`
-   `copy .env.example to .env file`
-   `docker compose up -d --build`
-   `docker compose exec phpmyadmin chmod 777 /sessions`
-   `docker compose exec php bash`
-   `chown -R www-data:www-data /var/www /var/www/bootstrap/cache`
-   `chmod -R 775 /var/www/storage /var/www/bootstrap/cache`
-   `add in app/Providers/AppServiceProvider boot method this line: view()->share('categoriesTree', Category::where('parent_id', null)->with('children')->get());`
-   `composer setup`

### From the second time onwards

-   `docker compose up -d`

# Notes

### Laravel App

-   URL: http://localhost

### Mailpit

-   URL: http://localhost:8025

### phpMyAdmin

-   URL: http://localhost:8080
-   Server: `db`
-   Username: `neelli`
-   Password: `neelli`
-   Database: `booksStore`

---
