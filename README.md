msg-spammer-v1

PHP >= 5.6.4
Laravel >= 5.4
Composer
Git
MySQL
Installation
git clone https://github.com/karoys/laravel-native-roles-auth.git projectname
cd projectname
composer install
cp .env.example .env
php artisan key:generate
Add your database info in .env
php artisan migrate to create and populate tables
php artisan db:seed to create some sample data
php artisan serve to start the app on http://localhost:8000/

-Run this to seed the database with dummy data, so role based authentication can be tested.
php artisan migrate:fresh --seed.

api user details : api_user@example.com
password : secret

authenticated user details : auth_user@example.com
password : secret

admin user details : admin@example.com
password : secret


You need to run this command in the terminal so mailing can work in a somewhat asynchronous manner,so as not to block the page.
php artisan queue:listen --tries 3 --timeout 30

