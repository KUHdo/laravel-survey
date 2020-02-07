<?php

namespace Kuhdo\Survey;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class SurveyServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @param Filesystem $filesystem
     * @return void
     */
    public function boot(Filesystem $filesystem)
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'kuhdo');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'kuhdo');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole($filesystem);
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
     * @param Filesystem $filesystem
     * @return void
     */
    protected function bootForConsole(Filesystem $filesystem)
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/survey.php' => config_path('survey.php'),
        ], 'survey.config');

        $this->publishes([
            __DIR__.'/../database/migrations/create_survey_tables.php.stub' => $this->getMigrationFileName($filesystem),
        ], 'migrations');

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

    /**
     * Returns existing migration file if found, else uses the current timestamp.
     *
     * @param Filesystem $filesystem
     * @return string
     */
    protected function getMigrationFileName(Filesystem $filesystem) : string
    {
        $timestamp = date('Y_m_d_His');

        return Collection::make($this->app->databasePath().DIRECTORY_SEPARATOR.'migrations'.DIRECTORY_SEPARATOR)
            ->flatMap(function ($path) use ($filesystem) {
                return $filesystem->glob($path.'*_create_survey_tables.php');
            })->push($this->app->databasePath()."/migrations/{$timestamp}_create_survey_tables.php")
            ->first();
    }
}
