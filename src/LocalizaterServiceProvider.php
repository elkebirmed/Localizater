<?php

namespace Getsupercode\Localizater;

use Illuminate\Support\ServiceProvider;

class LocalizaterServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish helpers.
        require __DIR__ . '/helpers.php';

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/localizater.php', 'localizater');

        // Register the service the package provides.
        $this->app->singleton('localizater', function ($app) {
            return new Localizater();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['localizater'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__ . '/../config/localizater.php' => config_path('localizater.php'),
        ], 'localizater.config');
    }
}
