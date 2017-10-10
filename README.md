# ShortDB
A PHP helper package to process static "database" content into dynamic content.

- [Installation](#installation)
- [Examples](#examples)

## Installation
This package requires PHP 5.4+.

To install through composer you can either use `composer require ferrisbane/shortdb` or include the package in your `composer.json`.

```php
"ferrisbane/shortdb": "0.1.*"
```

Then run either `composer install` or `composer update` to download the package.

To use the package with Laravel 5 add the ShortDB service provider to the list of service providers in `config/app.php`.

```php
'providers' => [
  Ferrisbane\ShortDB\Laravel5ServiceProvider::class
];
```

Then use `php artisan vendor:publish` to publish the config. 

To use the package you can either use the `ShortDB` facade or if you prefer using dependency injection ShortDB is bound to the IOC container by its interface.

The package comes with a helpful laravel helper function, just pass it a string and get a porcessed string back

```php
shortdb($string);
```


## Examples

This repo contains example code that can help you get started with a shortcode and how to use the shortcodes in your project

[Example Shortcode (FontAwesome)](ExampleShortcode.md)

[Example Controller Usage (FontAwesome Icons)](ExampleUsage.md)