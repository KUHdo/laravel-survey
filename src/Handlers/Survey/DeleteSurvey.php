<?php

namespace KUHdo\Survey\Handlers\Survey;

use Exception;
use KUHdo\Survey\Handlers\Handler;
use KUHdo\Survey\Models\Survey;

class DeleteSurvey extends Handler
{
    /**
     * Small delete survey handler for use in controller actions
     *
     * @throws Exception
     */
    public function __invoke(Survey $survey): Survey
    {
        $survey->delete();

        return $survey;
    }
}
