msg-spammer-v1

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

