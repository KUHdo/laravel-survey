<?php

namespace KUHdo\Survey\Handlers\Answer;

use KUHdo\Survey\Models\Answer;
use KUHdo\Survey\Handlers\Handler;
use KUHdo\Survey\Requests\AnswerRequest;

class UpdateAnswer extends Handler
{
    /**
     * Small update answer handler for use in controller actions
     *
     * @param AnswerRequest $request
     * @param Answer $answer
     * @return Answer
     */
    public function __invoke(AnswerRequest $request, Answer $answer): Answer
    {
        $inputs = $request->input();
        $answer->fill($inputs);
        $answer->save();

        return $answer;
    }
}
