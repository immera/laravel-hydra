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
        if (config('app.debug')) {
            $this->loadRoutesFrom(__DIR__.'/routes/hydra.php');
        }

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
    }
}
