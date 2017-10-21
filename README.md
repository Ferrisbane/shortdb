# ShortDB
A PHP helper package to process static content into dynamic content.

- [Installation](#installation)
- [Setup](#setup)
- [Usage](#usage)
- [Examples](#examples)

## Installation
This package requires PHP 5.4+.

To install through composer you can either use `composer require ferrisbane/shortdb` (while inside your project folder) or include the package in your `composer.json`.

```php
"ferrisbane/shortdb": "0.1.*"
```

Then run either `composer install` or `composer update` to download the package.

To use the package with Laravel 5 add the ShortDB service provider to the list of service providers in `config/app.php`.

```php
'providers' => [
    ...

    Ferrisbane\ShortDB\Laravel5ServiceProvider::class

    ...
];
```

Then use `php artisan vendor:publish` to publish the config.

If you have changed the namespace of your project you can define it inside `config/shortdb.php`

`'namespace' => 'App',`

## Setup
Once the shortdb package has been installed on your project you will need to setup/create a shortdb class.
This shortdb class will allow the shortdb package to convert static text and process it however you want.

In laravel create a `Shortcodes` folder inside your `app` folder.
You should now have a folder like: `/app/Shortcodes/`

Inside the `Shortcodes` folder create a php file, name it on what this class will process.
For example a file named: `FontAwesome.php`. This Font Awesome file will allow us process font awesome icons.

You can create as many shortcode files as needed in your project.

Take a look at our example Shortcode: [Example Shortcode (FontAwesome)](examples/FontAwesome.md)

Inside the shortcode class there are variables and functions that are used to load and process the shortcode:

- The `$code` variable is used to define the unique name/code of this shortcode.

- The `$description` variable is currently unused but will be used to describe what this shortcode does.

- The `$arguments` variable is an array of arguments the shortcode will accept, e.g. `'icon'`.
Inside the `'icon'` argument you can define if it is required:
```php
'icon' => [
    'required' => true
],
```

- The process function will `process` the shortcode. `public function process(array $arguments)`

The shortdb package will pass all arguments to this function, you can now process what you require inside, once done `return` your processed string.

Currently the `getJavascriptDescriptor` and `getOptions` functions are unused.

## Usage

Using the shortdb package is easy.

```php
app('shortdb')->process($string);
```

Or as the package comes with a useful laravel helper function, just call the helper and pass it a string, you will then get your processed string back

```php
shortdb($string);
```

Using the helper in blade:

```php
{!! shortdb($string) !!}
```


## Examples

This repo contains example code that can help you get started with a shortcode and how to use the shortcodes in your project

[Example Shortcode (FontAwesome)](examples/FontAwesome.md)

[Example Controller Usage (FontAwesome Icons)](examples/ControllerUsage.md)