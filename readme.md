# Localizater

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-styleci]][link-styleci]

Laravel package for wrapping routes in multiple locale prefixes.

## Installation

Via Composer

```bash
composer require getsupercode/localizater
```

To detect and change the locale of the application based on the request automatically, you can add the middleware to your `app/Http/Kernel`:

```php
protected $middlewareGroups = [
    'web' => [
        \Getsupercode\Localizater\LocalizaterMiddleware::class,
        // ...
    ]
];
```

## Configuration

By default, the application locales are only going to be en and the default locale is not prefixed. If you want to prefix the default locale, please run the following command to publish the configuration file:

```bash
php artisan vendor:publish --provider="Getsupercode\Localizater\LocalizaterServiceProvider" --tag="config"
```

After installing the package, Adding the middleware and publishing the configuration file. You need to edit the configuration file `config/localizater.php` in order to add more locales.

## Note

The default locale is `app.locale` located at `config/app.php` file.

### Config: `localizater.locales`

Add supported locales. It's recommended to write the locale value with its native language.

```php
'locales' => [
    'en' => 'English',
    'fr' => 'Français',
    'ar' => 'العربية',
]
```

### Config: `localizater.prefix_default`

If this option is set to true, Default locale URL will be prefixed.

```txt
true:
  www.example.com/en
  www.example.com/fr

false:
  www.example.com
  www.example.com/fr
```

### Config: `localizater.prefix_default_name`

If this option is set to true, Default locale route name will be prefixed.

**true:**

| Method | URI  | Name     |
| ------ | ---- | -------- |
| GET    | HEAD | /page    | en.page |
| GET    | HEAD | /fr/page | fr.page |

**false:**

| Method | URI  | Name     |
| ------ | ---- | -------- |
| GET    | HEAD | /page    | page |
| GET    | HEAD | /fr/page | fr.page |

## Usage

The package will not override the route features you already know. It's just a wrapper function that will create multiple locale routes for you.

```php
// routes/web.php

<?php

use Getsupercode\Localizater\Facades\Localizater;
use Illuminate\Support\Facades\Route;

Localizater::group(function () {
    Route::view('/', 'welcome')->name('welcome');

    Route::get('/user', 'UserController@index');
});

// Put other (Non read) route actions outside the `Localizater::group` as you don't need to have multiple locales for those actions.

Route::post('/user', 'UserController@store');
```

The above example will give us:

| Method    | URI      | Name       |
| --------- | -------- | ---------- |
| GET\|HEAD | /        | welcome    |
| GET\|HEAD | /fr      | fr.welcome |
| GET\|HEAD | /user    |            |
| GET\|HEAD | /fr/user | fr.        |
| POST      | /user    |            |

### Route naming

If you add a name to a route it will be prepended by the locale key `locale.name`. _for example: (`fr.welcome`)_

All locales without a name will have the same prefix name like `fr.`. And this is normal as you don't need its names.

### Localizater attributes

You can add attributes to the localizer group function as you do with the route group function.

```php
Localizater::group(['middleware' => 'auth'], function () {
    Route::view('/home', 'home')->name('home');
});
```

Or:

```php
Localizater::group(function () {
    Route::group(['middleware' => 'auth'], function () {
        Route::view('/home', 'home')->name('home');
    });
});
```

### Get route URL in a specified locale

You can get the current route URL in different locale key:

```php
// Current route URL: example.com

locale_route('fr');

// Output: example.com/fr
```

Or a named route:

```php
// Route URL: example.com/fr/home

locale_route('en', 'home');

// Output: example.com/home
```

You can pass the same parameters as the [`route()`](https://laravel.com/docs/7.x/helpers#method-route) function after the locale parameter.

```php
// locale_route($locale, $route, $parameters, $absolute);

// Current route
locale_route('fr', null, ['status' => 'active'], true);

// Named route
locale_route('fr', 'home', ['status' => 'active'], true);
```

### Get locale language name

You can get the value of the locale key in `localizater.locales` configuration for the current locale or a specified locale:

```php
locale_name();
// Output: English

locale_name('fr');
// Output: Français

locale_name('ar');
// Output: العربية
```

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

```bash
composer test
```

## Contributing

Please see [contributing.md](contributing.md) for details.

## Security

If you discover any security related issues, please email elkebir.med@gmail.com instead of using the issue tracker.

## Credits

- [Mohamed Elkebir][link-author]
- [All Contributors][link-contributors]

## License

MIT. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/getsupercode/localizater.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/getsupercode/localizater.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/getsupercode/localizater/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield
[link-packagist]: https://packagist.org/packages/getsupercode/localizater
[link-downloads]: https://packagist.org/packages/getsupercode/localizater
[link-travis]: https://travis-ci.org/getsupercode/localizater
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/getsupercode
[link-contributors]: ../../contributors
