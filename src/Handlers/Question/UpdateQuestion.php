<?php

namespace Kuhdo\Survey\Handlers\Question;

use Kuhdo\Survey\Handlers\Handler;
use Kuhdo\Survey\Question;
use Kuhdo\Survey\Requests\QuestionRequest;

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
