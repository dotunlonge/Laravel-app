msg-spammer-v1

You need to run this command in the terminal so mailing can work in a somewhat asynchronous manner,so as not to block the page.

php artisan queue:listen --tries 3 --timeout 30

