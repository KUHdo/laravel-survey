<?php

namespace KUHdo\Survey\Handlers\Survey;

use KUHdo\Survey\Handlers\Handler;
use KUHdo\Survey\Requests\SurveyRequest;
use KUHdo\Survey\Survey;

class StoreSurvey extends Handler
{
    public function __invoke(SurveyRequest $request)
    {
        $inputs = $request->input();

        $survey = new Survey($inputs);

        $survey->save();

        return $survey;
    }
}
