<?php

namespace Kuhdo\Survey\Handlers\Question;

use Kuhdo\Survey\Handlers\Handler;
use Kuhdo\Survey\Question;
use Kuhdo\Survey\Requests\QuestionRequest;
use Kuhdo\Survey\Survey;

class StoreQuestion extends Handler
{
    public function __invoke(QuestionRequest $request)
    {
        $inputs = $request->input();

        $survey = Survey::findOrFail($inputs['survey_id']);

        $question = new Question($inputs);

        $question->survey()->associate($survey);

        $question->save();

        return $survey;
    }
}
