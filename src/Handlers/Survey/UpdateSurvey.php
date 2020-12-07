<?php

namespace KUHdo\Survey\Handlers\Survey;

use KUHdo\Survey\Handlers\Handler;
use KUHdo\Survey\Requests\SurveyRequest;
use KUHdo\Survey\Survey;

class UpdateSurvey extends Handler
{
    public function __invoke(SurveyRequest $request, Survey $survey)
    {
        $inputs = $request->input();

        $survey->fill($inputs);

        $survey->save();

        return $survey;
    }
}
