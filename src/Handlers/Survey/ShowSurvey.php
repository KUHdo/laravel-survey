<?php

namespace KUHdo\Survey\Handlers\Survey;

use KUHdo\Survey\Handlers\Handler;
use KUHdo\Survey\Models\Survey;

class ShowSurvey extends Handler
{
    /**
     * Small show survey handler for use in controller actions
     */
    public function __invoke(Survey $survey): Survey
    {
        return $survey;
    }
}
