<?php

namespace Ferrisbane\ShortDB;

use Illuminate\Support\ServiceProvider;

class Laravel5ServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        // Set the files to publish
        $this->publishes([
            __DIR__ . '/../config/shortdb.php' => config_path('shortdb.php')
        ], 'shortdb');

        $this->mergeConfigFrom(__DIR__ . '/../config/shortdb.php', 'shortdb');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->alias('Ferrisbane\ShortDB\ShortDB', 'shortdb');
        $this->app->bind('Ferrisbane\ShortDB\Contracts\ClassHelper',
            'Ferrisbane\ShortDB\ClassHelper');
    }

    /**
     * Get the package config.
     *
     * @return array
     */
    protected function getConfig()
    {
        return config('shortdb');
    }
}
