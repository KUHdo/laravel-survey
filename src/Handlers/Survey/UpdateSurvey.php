<?php

namespace KUHdo\Survey\Handlers\Survey;

use KUHdo\Survey\Handlers\Handler;
use KUHdo\Survey\Requests\SurveyRequest;
use KUHdo\Survey\Models\Survey;

class UpdateSurvey extends Handler
{
    /**
     * Small update survey handler for use in controller actions
     *
     * @param SurveyRequest $request
     * @param Survey $survey
     * @return Survey
     */
    public function __invoke(SurveyRequest $request, Survey $survey): Survey
    {
        $inputs = $request->input();
        $survey->fill($inputs);
        $survey->save();

        return $survey;
    }
}
