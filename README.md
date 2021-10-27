# Blog-Laracast <hr>

Application created using Laravel following the web course on [Laracast](https://laracasts.com/series/laravel-8-from-scratch).

### Installation <hr>
First clone this repository, install the dependencies, and setup your `.env` file.
```bash
https://github.com/Andrea-Agosta/blog-laracast.git
composer install
cp .env.example .env
```
Then create the necessary database.
```bash
php artisan db
create database blog
```

And run the initial migrations and seeders.
```bash
php artisan migrate --seed
```
