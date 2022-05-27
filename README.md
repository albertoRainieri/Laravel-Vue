

## About Repository

A very simple Laravel 8 + Vue 2

## Tech Specification

- Laravel 8
- Vue 2 + VueRouter + vue-progressbar + sweetalert2 + laravel-vue-pagination
- Laravel Passport
- Admin LTE 3 + Bootstrap 4 + Font Awesome 5
- PHPUnit Test Case/Test Coverage

## Features

[//]: # (- Modal based Create+Edit, List with Pagination, Delete with Sweetalert)

[//]: # (- Login, Register, Forget+Reset Password as default auth)

[//]: # (- Profile, Update Profile, Change Password, Avatar)

[//]: # (- Product Management )

[//]: # (- User Management)

[//]: # (- Settings: Categories, Tags)

[//]: # (- Frontend and Backend User ACL with Gate Policy &#40;type: admin/user&#41;)

[//]: # (- Simple Static Dashboard)

[//]: # (- Developer Options for OAuth Clients and Personal Access Token)

[//]: # (- Build with Docker)


## Install with Docker
- `git clone https://github.com/albertoRainieri/FullStack_Application_Laravel_Vue.js.git`
- `cd FullStack_Application_Laravel_Vue.js/Docker`
- `cp .env.example .env`
- `docker-compose up -d mysql phpmyadmin apache2 php-fpm workspace`
- `docker-compose exec workspace bash`
- `composer install`
- `cp .env.example .env`
- `npm install`
- `php artisan key:generate`
- `php artisan migrate`
- `php artisan db:seed`
- `php artisan passport:install`

- Navigate to: http://localhost/
- Login as 'admin' with these credentials: 'email': admin@admin.com, 'password': 'adminpass'
- PhpMyAdmin for Database http://localhost:8081/


## About The Application

<p align="center">

![alt text](./Workspace/public/images/Dashboard.png?raw=true)
![alt text](./Workspace/public/images/SupplierSection.png?raw=true)

</p>

Working in progress E-commerce platform.
There are three roles:
1) Admin
2) Supplier
3) User

The users can add product to their own carts, the suppliers can add their products to the main dashboard and finally the admin can see and do anything.