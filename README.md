
# MY PRODUCT


## Quick start

-   Clone the repo: `git clone https://github.com/muh-arga/my-product.git`
-   Run `cd` to the newly created `/my-product` directory
-   Run `composer install` command
-   Run `npm install` command
-   Run `cp .env.example .env` command
-   Setup database connection on `.env`
-   Add `SENTRY_LARAVEL_DSN=https://2fa46660d60a67e7d34ca8de7597ddf5@o4505675115855872.ingest.sentry.io/4505675116969984` to your `.env`
-   Run `php artisan key:generate` command
-   Run `php artisan serve` command
-   Done


## User Account

    1. Super Admin (User Management)
        Email   : superadmin@gmail.com
        Password: password

        Feature : create user, edit user, delete user

    2. Admin
        Email   : admin@gmail.com
        Password: password

        Feature : create product, edit product, delete product, show product, add user, change user role to admin

    3. User
        Email   : user1@gmail.com
        Password: password

        Feature : show product

    