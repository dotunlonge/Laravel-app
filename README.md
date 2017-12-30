# LARAVEL BASED SMS WEB APPLICATION

A simple web application for sending messages to mobile numbers, utilising guzzle to make api requests .

Allows for user login and signup with email confirmation.

Also configured to have role based authentication.



## Requirements

- PHP >= 7.0.0

- Laravel >= 5.4

- Composer

- Git

- MySQL

- API Credentials from http://pluralsms.com/sms/

- Basic Knowledge Of Running Command In The Terminal.

- Twitter App Credentials

- Facebook App Credentials

  ​
## Installation

- [ ] Git Clone. 

- [ ] cd projectname/app.

- [ ] run composer install.

- [ ] cp .env.example .env

- [ ] php artisan key:generate

- [ ] Add your database and another neccesary information  to the .env file. i.e.

      ```
      //Everything detailed here is B.S.

      PLURALSMS_USERNAME = username
      PLURALSMS_PASSWORD = password

      FACEBOOK_APP_ID = 567890987654321
      FACEBOOK_CLIENT_SECRET = 2321312312j23123123l12323213u23u
      FACEBOOK_CALLBACK_URL = http://localhost:8000/auth/facebook/callback

      TWITTER_APP_ID = 23232uu3232132iu233y3
      TWITTER_CLIENT_SECRET = eeuoruvuroeuwvirerneo8vwrewrwe8rv9ewnew 
      TWITTER_CALLBACK_URL = http://localhost:8000/auth/twitter/callback

      DB_CONNECTION=mysql
      DB_HOST=localhost
      DB_PORT=8888
      DB_DATABASE=app
      DB_USERNAME=root
      DB_PASSWORD=root
      ```


- [ ] run the code below in the terminal to create the database schema and populate it with seed data.

```
 php artisan migrate:fresh --seed
```
run the below code to start the app on ***http://localhost:8000/***
```
php artisan serve 
```

- [ ] if error is encountered while trying to use social media login, go to

      ```
      projectname/app/vendor/laravel/socialite/src/
      ```

      and for both folders, One and Two...

      ***<u>Replace set with put</u>***, in the AbstractProvider.php file for the redirect method i.e.

```
   public function redirect()
    {
        $state = null;

        if ($this->usesState()) {
            //change here 
            $this->request->session()->set('state', $state = $this->getState());
        }

        return new RedirectResponse($this->getAuthUrl($state));
    }

   public function redirect()
    {
        $state = null;

        if ($this->usesState()) {
            //new statement
            $this->request->session()->put('state', $state = $this->getState());
        }

        return new RedirectResponse($this->getAuthUrl($state));
    }
```



## Testing

#### Role Based Authentications

To test the role based authentication setup, start up the server and login with one of these.

```
email : api_user@example.com
password : secret // the password is literally 'secret'
```

```
email : auth_user@example.com
password : secret // the password is literally 'secret'
```

```
email : admin@example.com
password : secret // the password is literally 'secret'
```



#### To Recieve Confirmation Emails

- [ ] Replace the Mail configuration with your credentials either from google or some other emailing platform, the configurations are in the ***.env file.***

- [ ] cd into the project directory in the terminal and run the code below

      ```
      php artisan queue:listen --tries 3 --timeout 30
      ```

 so mailing can work in a somewhat asynchronous manner,so as not to block the page.

