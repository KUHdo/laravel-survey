<?php

namespace Kuhdo\Survey\Handlers\Survey;

use Kuhdo\Survey\Handlers\Handler;
use Kuhdo\Survey\Survey;

class DeleteSurvey extends Handler
{
    public function __invoke(Survey $survey)
    {
        $survey->delete();

        return $survey;
    }
}