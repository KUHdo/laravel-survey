<?php

namespace KUHdo\Survey\Handlers\Question;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use KUHdo\Survey\Handlers\Handler;
use KUHdo\Survey\Models\Question;
use KUHdo\Survey\Models\Survey;
use KUHdo\Survey\Requests\QuestionRequest;

class StoreQuestion extends Handler
{
    /**
     * Small store question handler for use in controller actions
     *
     * @throws ModelNotFoundException
     */
    public function __invoke(QuestionRequest $request): Survey
    {
        $inputs = $request->input();
        $survey = Survey::findOrFail($inputs['survey_id']);
        $question = new Question($inputs);
        $question->survey()->associate($survey);
        $question->save();

        return $survey;
    }
}
