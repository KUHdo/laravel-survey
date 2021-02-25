<?php

namespace KUHdo\Survey\Handlers\Question;

use KUHdo\Survey\Handlers\Handler;
use KUHdo\Survey\Models\Question;
use KUHdo\Survey\Requests\QuestionRequest;

class UpdateQuestion extends Handler
{
    /**
     * Small update question handler for use in controller actions
     *
     * @param QuestionRequest $request
     * @param Question $question
     * @return Question
     */
    public function __invoke(QuestionRequest $request, Question $question): Question
    {
        $inputs = $request->input();
        $question->fill($inputs);
        $question->save();

        return $question;
    }
}
