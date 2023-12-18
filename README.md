<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Installation

Clone the repo

```shell
git clone https://github.com/Pr4vD4/swc-test-task-api.git
cd swc-test-task-api
```

Install dependencies
```shell
composer install
```

Set up the *.env* file.

Generate the key

```shell
php artisan key:generate
```

Migrate tables
```shell
php artisan migrate
```

You can use postman collection to make API requests *swc-test-task.postman_collection.json* (in project root)

### Info

Authorization was made using JWT token
