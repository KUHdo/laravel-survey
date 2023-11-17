<?php

namespace KUHdo\Survey\Handlers\Survey;

use KUHdo\Survey\Handlers\Handler;
use KUHdo\Survey\Models\Survey;
use KUHdo\Survey\Requests\SurveyRequest;

class StoreSurvey extends Handler
{
    /**
     * Small store survey handler for use in controller actions
     */
    public function __invoke(SurveyRequest $request): Survey
    {
        $inputs = $request->input();
        $survey = new Survey($inputs);
        $survey->save();

        return $survey;
    }
}
