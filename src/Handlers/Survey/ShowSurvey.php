<?php

namespace KUHdo\Survey\Handlers\Survey;

use KUHdo\Survey\Survey;
use KUHdo\Survey\Handlers\Handler;

class ShowSurvey extends Handler
{
    public function __invoke(Survey $survey)
    {
        return $survey;
    }
}
