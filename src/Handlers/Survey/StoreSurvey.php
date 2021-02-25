<?php

namespace KUHdo\Survey\Handlers\Survey;

use KUHdo\Survey\Handlers\Handler;
use KUHdo\Survey\Requests\SurveyRequest;
use KUHdo\Survey\Models\Survey;

class StoreSurvey extends Handler
{
    /**
     * Small store survey handler for use in controller actions
     *
     * @param SurveyRequest $request
     * @return Survey
     */
    public function __invoke(SurveyRequest $request): Survey
    {
        $inputs = $request->input();
        $survey = new Survey($inputs);
        $survey->save();

        return $survey;
    }
}
