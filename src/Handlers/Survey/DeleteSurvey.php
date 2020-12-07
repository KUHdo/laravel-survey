<?php

namespace KUHdo\Survey\Handlers\Survey;

use KUHdo\Survey\Handlers\Handler;
use KUHdo\Survey\Survey;

class DeleteSurvey extends Handler
{
    public function __invoke(Survey $survey)
    {
        $survey->delete();

        return $survey;
    }
}
