<?php

namespace KUHdo\Survey\Handlers\Survey;

use KUHdo\Survey\Handlers\Handler;
use KUHdo\Survey\Models\Survey;
use KUHdo\Survey\Requests\SurveyRequest;

class UpdateSurvey extends Handler
{
    /**
     * Small update survey handler for use in controller actions
     */
    public function __invoke(SurveyRequest $request, Survey $survey): Survey
    {
        $inputs = $request->input();
        $survey->fill($inputs);
        $survey->save();

        return $survey;
    }
}
