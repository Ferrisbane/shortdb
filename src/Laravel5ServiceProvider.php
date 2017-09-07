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
        // Set the directory to load views from
        $this->loadViewsFrom(__DIR__ . '/../views', 'shortdb');

        // Set the files to publish
        $this->publishes([
            __DIR__ . '/../config/shortdb.php' => config_path('shortdb.php'),
            __DIR__ . '/../database/migrations/' => base_path('database/migrations')
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
