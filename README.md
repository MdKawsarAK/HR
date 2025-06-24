<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

sit.txt
Download latest Composer and setup

Step1: open command prompt and apply the following command:
composer global require laravel/installer

Step2: Set environment variable to System PATH
%USERPROFILE%\AppData\Roaming\Composer\vendor\bin

Step3: apply the following commnad at command prompt

laravel new app1
or
composer create-project laravel/laravel app1


 cd app1
➜ composer run dev
php artisan serve
http://127.0.0.1:8000


Commands:
php artisan make:controller ArticleController
php artisan make:model Product
php artisan make:controller PhotoController --resource
php artisan make:controller PhotoController --resource --model=Photo
php artisan install:api
php artisan make:controller Api/PhotoController --api
php artisan make:resource PhotoResource --api

php artisan make:component Forms/Input
php artisan make:component forms.input --view

Route:
Route::get('/home', function () {
    echo "home";
   // return view('welcome');
});

Route::get('/home',[HomeController::class, 'index']);
Route::resource('posts', PostController::class);

Route::resources([
    'photos' => PhotoController::class,
    'posts' => PostController::class,
]);

Route::apiResources([
    'photos' => PhotoController::class,
    'posts' => PostController::class,
]);

Route::get('/user/{id}', function (string $id) {
    return 'User '.$id;
});


Verb          Path                        Action  Route Name
GET           /users                      index   users.index
GET           /users/create               create  users.create
POST          /users                      store   users.store
GET           /users/{user}               show    users.show
GET           /users/{user}/edit          edit    users.edit
PUT|PATCH     /users/{user}               update  users.update
DELETE        /users/{user}               destroy users.destroy



https://medium.com/@hossamsoliuman/route-resources-in-laravel-6e1f9336528c

<input name="_token" type="hidden" value="{{ csrf_token() }}"/>


Clear all caches in Laravel
===========================
php artisan optimize:clear
php artisan cache:clear
php artisan config:clear
php artisan event:clear
php artisan route:clear
php artisan schedule:clear-cache
php artisan view:clear
php artisan make:controller Api/ProductController --api


to disable cache set to ENV
================
CACHE_DRIVER=null



Create your own library:helpers
-------------------------------

Create you own library or helpers at the app folder and load it up with composer:

"autoload": {
    "classmap": [
        ...
    ],
    "psr-4": {
        "App\\": "app/"
    },
   "files":[
            "app/Helpers/html_helper.php",
            "app/Helpers/form_helper.php",
            "app/Helpers/seo_helper.php",
            "app/Helpers/file_helper.php",
            "app/Helpers/db_helper.php",
            "app/Helpers/page_helper.php",
            "app/Libraries/File.class.php",
            "app/Libraries/Form.class.php",
            "app/Libraries/Html.class.php",
            "app/Libraries/Db.class.php",
            "app/Libraries/Page.class.php",
            "app/Libraries/Table.class.php"
            //composer dump-autoload
        ]
},
After adding that to your composer.json file, run the following command:

composer dump-autoload


Article:
https://jurin.medium.com/make-laravel-api-even-more-flexible-with-artisan-resource-3f2a0aa322f


Authentication:
------------------------
composer require laravel/breeze --dev
php artisan breeze:install
php artisan migrate


note:  php artisan make:command GenerateCrud --command=make:crud
php artisan generate:crud employees
php artisan generate:crud employees --force# HR
php artisan generate:crud districts  
