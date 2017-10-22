# ShortDB
A PHP helper package to process static content into dynamic content.

- [Examples](#examples)
- [Installation](#installation)
- [Setup](#setup)
- [Usage](#usage)

## Examples

Below are helpful examples, however if you have not setup the shortdb package before please read the [Installation](#installation) guide first.

This repo contains example shortcodes and useful code showing you how to use the package in your projects:

- [Example Shortcode (FontAwesome)](examples/FontAwesome.md)
- [Example Controller Usage (FontAwesome Icons)](examples/ControllerUsage.md)



## Installation
This package requires PHP 5.6+ (has not been tested on lower versions).

The package works on Windows and Linux webservers (not been tested on Mac)

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


You should now have a project structure that looks like: `/app/Shortcodes/`

Inside the `Shortcodes` folder create a php file, name it on what this class will process.


For example a file named: `FontAwesome.php`. This Font Awesome file will allow us process font awesome icons.

You can create as many shortcode files as needed in your project.

Take a look at our example FontAwesome Shortcode: [Example Shortcode (FontAwesome)](examples/FontAwesome.md)

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

### Formatting the shortcode string

First you will need a string, this can be from a database, env, config etc.

Lets say the string we have is:
```php
$string = '{fa|icon:camera-retro}';
```
The shortdb package will look for `shortcodes` within curly brackets `{}` inside the passed string.

The shortcode can be anywhere within the string and you can have multiple different shortcodes, for example:
```php
$string = 'content... {fa|icon:camera-retro} ...more content... {fa|icon:cog} ...even more content';
```

The shortcode allows multiple arguments, the first in the above example: `fa` tells the shortdb package what shortcode to use.

This is defined in the shortcode php file using the `$code` variable. This will need to be unique.

We can then add more arguments to the shortcode, these are split using a pipe `|` for example `shortcodekey|argument1|argument2`.

Each argument can be passed values (just like a key value pair). To pass values with the argument use a colon `:` for example `icon:cog`

This will pass an argument to your shortcode process function. You can get the value using
```php
$arguments['icon']
```
If we passed `icon:cog` in the shortcode, when calling the above inside the process function we will retrieve `cog`.

### Processing a string

Passing the 'unprocessed' string to the below function/helper will then process into a dynamic content,
in our example it will be a FontAwesome html icon tag.

For example `{fa|icon:cog|spin:true}` will be processed into `<i class="fa fa-cog fa-spin" aria-hidden="true"></i>`

Processing a FontAwesome icon is just the start, by creating your own you can process whatever you need.

For example `{ip|country:name}` can be processed into `United Kingdom` based on the connecting client ip address.

Or `{price|product:my-product-slug|currency:gbp}` into `£100` or `{price|product:another-product|currency:usd}` into `$259`

This is useful if you want to place dynamic content (product price) within 'static' content (e.g. database content).
Useful if using a text editor/wysiwyg where html or dynamic would not work. 

#### Function/Helper

In laravel we can pass our string to the shortdb service container instance:
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