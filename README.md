# Laravel Docker E-commerce

-   AJAX Cart Functionality
-   AJAX Product mixed filtration (price, year, title, category) feature
-   Full checkout process with Stripe API
-   Eloquent model relationships
-   User admin/user roles
-   CRUD for admin user (categories, products, comments/reviews)
-   SMTP Email verification with mailpit
-   Product's review feature

# Setup

### For first time only

-   `git clone https://github.com/refactorian/laravel-docker.git`
-   `cd laravel-docker`
-   `copy .env.example to .env file`
-   `docker compose up -d --build`
-   `docker compose exec phpmyadmin chmod 777 /sessions`
-   `docker compose exec php bash`
-   `chown -R www-data:www-data /var/www /var/www/bootstrap/cache`
-   `chmod -R 775 /var/www/storage /var/www/bootstrap/cache`
-   `add in app/Providers/AppServiceProvider boot method this line: view()->share('categoriesTree', Category::where('parent_id', null)->with('children')->get());`
-   `php artisan migrate --seed`
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

### users profile

-   Email: any email in db users table
-   Password: password
-   ***
