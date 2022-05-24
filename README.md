

## About Repository

A very simple Laravel 8 + Vue 2 + AdminLTE 3 based Curd Starter template for SPA Application.

[//]: # (<p align="center">)

[//]: # (<img src="https://i.imgur.com/mZAHbUL.png">)

[//]: # (<img src="https://i.imgur.com/3hhoQnq.png">)

[//]: # (<img src="https://i.imgur.com/aHtQkYl.png">)

[//]: # (<img src="https://i.imgur.com/V7OuwLn.png">)

[//]: # (</p>)

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
- PhpMyAdmin for Database http://localhost:8081/


[//]: # (## Unit Test)

[//]: # ()
[//]: # (#### run PHPUnit)

[//]: # ()
[//]: # (```bash)

[//]: # (# run PHPUnit all test cases)

[//]: # (vendor/bin/phpunit)

[//]: # (# or Feature test only)

[//]: # (vendor/bin/phpunit --testsuite Feature)
[//]: # (```)

[//]: # ()
[//]: # (#### Code Coverage Report)

[//]: # ()
[//]: # (```bash)

[//]: # (# reports is a directory name)

[//]: # (#vendor/bin/phpunit --coverage-html reports/)

[//]: # (```)

[//]: # (A `reports` directory has been created for code coverage report. Open the dashboard.html.)

[//]: # ()
[//]: # ()
[//]: # (## Credit)

[//]: # (This repository is motivated by [Hujjat/laravStart]&#40;https://github.com/Hujjat/laravStart&#41; and his awesome video tutorial in [Youtube]&#40;https://www.youtube.com/playlist?list=PLB4AdipoHpxaHDLIaMdtro1eXnQtl_UvE&#41;.)

[//]: # ()
[//]: # (## License)

[//]: # ()
[//]: # ([MIT license]&#40;https://opensource.org/licenses/MIT&#41;.)
