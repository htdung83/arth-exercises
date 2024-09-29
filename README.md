<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Prerequisite
Before installation, you have to sure that your machine have enough condition to run the project. Please check the list below:
1. PHP >= 8.2 with extensions:<br>
   - Ctype PHP Extension
   - cURL PHP Extension
   - DOM PHP Extension<br>
   - Fileinfo PHP Extension<br>
   - Filter PHP Extension<br>
   - Hash PHP Extension<br>
   - Mbstring PHP Extension<br>
   - OpenSSL PHP Extension<br>
   - PCRE PHP Extension<br>
   - PDO PHP Extension<br>
   - Session PHP Extension<br>
   - Tokenizer PHP Extension<br>
   - XML PHP Extension
2. MySQL 8 or MariaDB 10.21.*
2. Node.js 18+
3. [optional] Web server Apache or Nginx

## Installation

1. Extract the zip file of project.
2. Open the project folder by your IDE (Visual Studio, PHPStorm, ...)
3. Setup database information in your `.env` file. If you don't see .env file, duplication `.env.example` and rename. Edit database as below:
   - DB_CONNECTION=mysql
   - DB_HOST=127.0.0.1
   - DB_PORT=3306
   - DB_DATABASE=<your database name>
   - DB_USERNAME=<your database user>
   - DB_PASSWORD=<your database password>
5. Run command `composer install`
6. Run command `php artisan key:generate`
7. Run command `php artisan migrate --seed`
8. Run command `php artisan storage:link`
9. Run command `npm install`
10. Run command `npm run build`
11. Run command `php artisan serve`
12. Access your website at `http://localhost:8000`
