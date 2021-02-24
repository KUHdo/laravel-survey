<?php

namespace KUHdo\Survey;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class SurveyApplicationServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'KUHdo\Survey\Models\Survey' => 'KUHdo\Survey\Policies\SurveyPolicy',
        'KUHdo\Survey\Models\Question' => 'KUHdo\Survey\Policies\QuestionPolicy',
        'KUHdo\Survey\Models\Answer' => 'KUHdo\Survey\Policies\AnswerPolicy',
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
