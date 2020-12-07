<?php

namespace KUHdo\Survey\Handlers\Question;

use KUHdo\Survey\Handlers\Handler;
use KUHdo\Survey\Question;
use KUHdo\Survey\Requests\QuestionRequest;
use KUHdo\Survey\Survey;

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
