## About Auth Starter

It's  a [Laravel 8](https://laravel.com/docs) authentication markdown that will help you to understand and grasp all the underlying functionality for Session and API Authentication which include:
- User & Admin Sessions
- Admin Roles & Permissions
- Authentication Middleware for Users and Admins
- Gates and Policies
- Form Request
- API Resources
- Auth Sanctum
- Notifications 
- Social Login with socialite
- API Endpoints to accomplish social login from mobile or frontend applications

feel free to use it as a startup for your next Laravel project

## User Features

User has the following features provided as Web and API

- Routing
- Email & Password Authentication
- Login, Register, Update Profile
- Forget Password functionality
- Email Verification functionality
- Social Login with google and facebook login
- Protecting some routes against un verified emails
- Protecting routes against admin sessions
- Protecting some routes against guests
- File Upload
- UI is built with [Bootstrap 5](https://getbootstrap.com/docs/5.1/getting-started/introduction/)

## Admin Features

Admin has the following features provided as Web and API

- Routing
- Email & Password Authentication
- Login, Update Profile
- Protecting routes against user sessions
- Protecting some routes against guests
- Control Admins
- Control Users
- Policies for admin roles
- UI is built with [Purple Dashboard](https://www.bootstrapdash.com/product/purple-free-admin-template/)


## Installation

First clone this repository, install the dependencies, and setup your .env file.

```
git clone https://github.com/samialateya/Auth-Starter.git
composer install
cp .env.example .env
```

Then create new database and run the migrations.

```
php artisan db migrate
```

Run the initial migrations and seeders to create an admin account aside with admin roles.

```
php artisan db:seed
```

<b>
	Update your ENV file with the email driver credentials<br>
	and social login keys
</b>

lastly you need to setup and run the queue worker in order to send email in background.
run the following commands and then update ENV QUEUE_CONNECTION=database
```
php artisan queue:table

php artisan queue:work
```

you are good to go now in another terminal serve the application
```
php artisan serve
```

## Contributing

Thank you for considering contributing to AuthStarter.
Feel free to fork this repo and submit a pull request with your updates

## Errors and Vulnerabilities

Please open an issue on Github if you discover a vulnerability or you face an error with this repo.
and feel free to contact me at [samialateya@hotmail.com](mailto:samialateya@hotmail.com)
