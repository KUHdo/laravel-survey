<?php

namespace Kuhdo\Survey;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class SurveyApplicationServiceProvider extends ServiceProvider
{
    protected $policies = [
        'Kuhdo\Survey\Survey' => 'Kuhdo\Survey\Policies\SurveyPolicy',
        'Kuhdo\Survey\Question' => 'Kuhdo\Survey\Policies\QuestionPolicy',
        'Kuhdo\Survey\Answer' => 'Kuhdo\Survey\Policies\AnswerPolicy',
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
