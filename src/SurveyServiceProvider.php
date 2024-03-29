<?php

namespace KUHdo\Survey;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use KUHdo\Survey\Facades\Survey;

class SurveyServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(Filesystem $filesystem)
    {
        $this->registerRoutes();

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole($filesystem);
        }
    }

    /**
     * Register the Survey routes.
     */
    protected function registerRoutes(): void
    {
        Route::group([
            'namespace' => config('survey.routes.namespace'),
            'prefix' => config('survey.routes.prefix'),
            'middleware' => config('survey.routes.middleware'),
        ], function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        });
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
        $this->app->singleton('survey', fn ($app) => new Survey);

        $this->app->bind(
            'KUHdo\Survey\Repositories\Answer\AnswerRepository',
            'KUHdo\Survey\Repositories\Answer\EloquentAnswerRepository'
        );

        $this->app->bind(
            'KUHdo\Survey\Repositories\Question\QuestionRepository',
            'KUHdo\Survey\Repositories\Question\EloquentQuestionRepository'
        );

        // App model binding via config
        $this->app->bind(
            Contracts\Survey::class,
            config('survey.models.survey')
        );
        $this->app->bind(
            Contracts\Question::class,
            config('survey.models.question')
        );
        $this->app->bind(
            Contracts\Answer::class,
            config('survey.models.answer')
        );
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
    protected function bootForConsole(Filesystem $filesystem)
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/survey.php' => config_path('survey.php'),
        ], 'survey.config');

        $this->publishes([
            __DIR__.'/../database/migrations/create_survey_tables.php.stub' => $this->getMigrationFileName($filesystem),
        ], 'migrations');

        $this->publishes([
            __DIR__.'/../stubs/SurveyServiceProvider.stub' => app_path('Providers/SurveyServiceProvider.php'),
        ], 'horizon-provider');

        $this->publishPolicies();
    }

    /**
     * Publishes policies.
     */
    protected function publishPolicies()
    {
        $this->publishes([
            __DIR__.'/../stubs/SurveyPolicy.stub' => app_path('Policies/SurveyPolicy.php'),
        ], 'survey-policy');

        $this->publishes([
            __DIR__.'/../stubs/QuestionPolicy.stub' => app_path('Policies/QuestionPolicy.php'),
        ], 'question-policy');

        $this->publishes([
            __DIR__.'/../stubs/AnswerPolicy.stub' => app_path('Policies/AnswerPolicy.php'),
        ], 'answer-policy');
    }

    /**
     * Returns existing migration file if found, else uses the current timestamp.
     */
    protected function getMigrationFileName(Filesystem $filesystem): string
    {
        $timestamp = date('Y_m_d_His');

        return Collection::make($this->app->databasePath().DIRECTORY_SEPARATOR.'migrations'.DIRECTORY_SEPARATOR)
            ->flatMap(function ($path) use ($filesystem) {
                return $filesystem->glob($path.'*_create_survey_tables.php');
            })->push($this->app->databasePath()."/migrations/{$timestamp}_create_survey_tables.php")
            ->first();
    }
}
