<?php

namespace Kuhdo\Survey;

use Illuminate\Support\ServiceProvider;

class SurveyServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'kuhdo');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'kuhdo');
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
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/survey.php', 'survey');

        // Register the service the package provides.
        $this->app->singleton('survey', function ($app) {
            return new Survey;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['survey'];
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
            __DIR__.'/../config/survey.php' => config_path('survey.php'),
        ], 'survey.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/kuhdo'),
        ], 'survey.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/kuhdo'),
        ], 'survey.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/kuhdo'),
        ], 'survey.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
