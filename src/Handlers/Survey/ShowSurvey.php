<?php

namespace Kuhdo\Survey\Handlers\Survey;

use Kuhdo\Survey\Survey;
use Kuhdo\Survey\Handlers\Handler;

class ShowSurvey extends Handler
{
    public function __invoke(Survey $survey)
    {
        return $survey;
    }
}
