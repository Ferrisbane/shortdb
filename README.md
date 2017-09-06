# ShortDB
A PHP helper package to process static "database" content into dynamic content.

- [Installation](#installation)

## Installation
This package requires PHP 5.4+.

To install through composer you can either use `composer require Ferrisbane/shortdb` or include the package in your `composer.json`.

```php
"Ferrisbane/shortdb": "0.1.*"
```

Then run either `composer install` or `composer update` to download the package.

To use the package with Laravel 5 add the ShortDB service provider to the list of service providers in `config/app.php`.

```php
'providers' => [
  'Ferrisbane\ShortDB\Laravel5ServiceProvider'
];
```

Then add the `ShortDB` facade to the aliases array.

```php
'aliases' => [
  'ShortDB' => 'Ferrisbane\ShortDB\Facades\ShortDB',
];
```

Then use `php artisan vendor:publish` to publish the config. 

To use the package you can either use the `ShortDB` facade or if you prefer using dependency injection ShortDB is bound to the IOC container by its interface.