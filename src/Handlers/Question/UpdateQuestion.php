<?php

namespace KUHdo\Survey\Handlers\Question;

use KUHdo\Survey\Handlers\Handler;
use KUHdo\Survey\Question;
use KUHdo\Survey\Requests\QuestionRequest;

class UpdateQuestion extends Handler
{
    public function __invoke(QuestionRequest $request, Question $question)
    {
        $inputs = $request->input();

        $question->fill($inputs);

        $question->save();

        return $question;
    }
}
