<?php

namespace KUHdo\Survey\Handlers\Survey;

use KUHdo\Survey\Models\Survey;
use KUHdo\Survey\Handlers\Handler;

class ShowSurvey extends Handler
{
    /**
     * Small show survey handler for use in controller actions
     *
     * @param Survey $survey
     * @return Survey
     */
    public function __invoke(Survey $survey): Survey
    {
        return $survey;
    }
}
