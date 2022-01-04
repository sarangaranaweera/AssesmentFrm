# Assesment - XYZ Forum


## Laravel setup

### Install composer dependencies

```
cd backend
composer install
```

### Database Migrations

After installing composer dependencies, add your database credentials in `.env` file and then run migrations.
You can copy and paste .env.my content to .env file that is my local running env setup

```
php artisan migrate
```
### Create an Admin

After running migration , then run the `artisan seeder`

```
php artisan db:seed --class=UserSeeder
```
New admin will add to the database and use `admin@xyz.com` as admin email and `admin@321` as password.

Now, in the terminal run `artisan serve` command. It will run the application at `http://127.0.0.1:8000` URL, and that URL path used in the Vue.js app.

```
php artisan serve
```

If you are running the Laravel API on a different URL path, then you need to update the URL path in the `src/apis/Api.js` of the Vue.js app.

## Vue.js Project setup

```
cd frontend
npm install
```

### Compiles and hot-reloads for development

```
npm run serve
```
