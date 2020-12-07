<?php

namespace KUHdo\Survey;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class SurveyApplicationServiceProvider extends ServiceProvider
{
    protected $policies = [
        'KUHdo\Survey\Survey' => 'KUHdo\Survey\Policies\SurveyPolicy',
        'KUHdo\Survey\Question' => 'KUHdo\Survey\Policies\QuestionPolicy',
        'KUHdo\Survey\Answer' => 'KUHdo\Survey\Policies\AnswerPolicy',
    ];

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
