<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Database

Database jobportal.sql is attached in the repo.

## How to Run?
1. Rename the .env.example to .env
2. uncomment database information and write the database name "jobportal"
3. Import the database in mysql.
4. run composer install
5. run php artisan migrate
6. run php artisan serve
7. run npm run dev

## Users 
1. Admin type 1 from the users table
2. Users type 0 from the users table
3. Company 

## How to register Admin? 
Sign up through the signup form, and then open the database open user table then change the type  of that user to 1. now it will be your admin.

## Passwords
for existing users in the database all the emails have password 12345678

## Email Integration
Email setup is already done in the system using mailtrap you just have to paste yours mailtrap credentials in .env file and
run the command php artisan queue:work 

Email is setup on:
1. Job Creation by the company
2. Status of the application change by the company





