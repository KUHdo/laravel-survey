<?php

namespace Kuhdo\Survey\Handlers\Survey;

use Kuhdo\Survey\Handlers\Handler;
use Kuhdo\Survey\Requests\SurveyRequest;
use Kuhdo\Survey\Survey;

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
