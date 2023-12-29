# Install & Run

composer i
npm i
php artisan serve

# Command

<!-- clean route cache -->

php artisan route:cache

<!-- create a factory -->

php artisan make:factory CourseFactory --model=Course

<!-- create fake data -->

php artisan db:seed --class=UserSeeder
php artisan db:seed --class=CourseSeeder

<!-- create a controller -->

php artisan make:controller UserController --resource

<!-- create a form request used to validate -->

php artisan make:request StoreUser

<!-- create a migration with exact table name-->

php artisan make:migration create_course_user_table --create=course_user

<!-- Drop all tables and re-run all migrations -->

php artisan migrate:fresh

# Document

<!-- Laravel 10 authentication Tutorial -->

https://www.positronx.io/laravel-custom-authentication-login-and-registration-tutorial/

<!-- Associate users with roles and permissions -->

https://spatie.be/docs/laravel-permission/v6/basic-usage/basic-usage

<!-- Init Helpers -->

https://viblo.asia/p/tu-tao-helpers-trong-laravel-RQqKLwGb57z

<!-- flatpickr is a lightweight and powerful datetime picker. -->

https://flatpickr.js.org/

# Docker

docker-compose up -d
https://www.digitalocean.com/community/tutorials/how-to-set-up-laravel-nginx-and-mysql-with-docker-compose-on-ubuntu-20-04

<!-- Rebuild Docker -->
<!-- composer u -->

docker-compose down
docker-compose up --build -d

<!-- I get MySQL connection refused -->

https://laradock.io/help/
.env> DB_HOST=127.0.0.1 -> DB_HOST=db

# Config Docker to Ubuntu

MicrosoftStore -> install Ubuntu
account tung /pass 123456
Folder Tree -> Linux -> Ubuntu -> home -> tung -> git clone
VSCode -> left corn -> Open a Remote Window -> Connect to WSL

<!-- Open Ubuntu Command -->

ls -la
cd japanese_center/
code .

<!-- Open Docker Composer -->
<!-- Containers->app->exec -->

composer i
composer u

<!-- copy file .env -->

<!-- Try clearing your caches/configs. -->

php artisan clear-compiled
php artisan clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
php artisan config:clear
