<?php

namespace Immera\Hydra;

use Illuminate\Support\ServiceProvider;

class HydraServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'immera');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'immera');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

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
    public function register(): void
    {
        dd("a");
        $this->mergeConfigFrom(__DIR__.'/../config/hydra.php', 'hydra');

        // Register the service the package provides.
        $this->app->singleton('hydra', function ($app) {
            return new Hydra;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['hydra'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/hydra.php' => config_path('hydra.php'),
        ], 'hydra.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/immera'),
        ], 'hydra.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/immera'),
        ], 'hydra.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/immera'),
        ], 'hydra.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
