<?php

namespace Kuhdo\Survey\Handlers\Answer;

use Illuminate\Support\Facades\Auth;
use Kuhdo\Survey\Answer;
use Kuhdo\Survey\Handlers\Handler;
use Kuhdo\Survey\Requests\AnswerRequest;

class DeleteAnswer extends Handler
{
    public function __invoke(Answer $answer)
    {
        $answer->delete();

        return $answer;
    }
}