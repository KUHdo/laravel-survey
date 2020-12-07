<?php

namespace KUHdo\Survey\Handlers\Answer;

use Illuminate\Support\Facades\Auth;
use KUHdo\Survey\Answer;
use KUHdo\Survey\Handlers\Handler;
use KUHdo\Survey\Requests\AnswerRequest;

class DeleteAnswer extends Handler
{
    public function __invoke(Answer $answer)
    {
        $answer->delete();

        return $answer;
    }
}
