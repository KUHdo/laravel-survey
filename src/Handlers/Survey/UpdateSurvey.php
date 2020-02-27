<?php

namespace Kuhdo\Survey\Handlers\Survey;

use Kuhdo\Survey\Handlers\Handler;
use Kuhdo\Survey\Requests\SurveyRequest;
use Kuhdo\Survey\Survey;

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