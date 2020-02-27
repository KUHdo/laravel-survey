<?php

namespace Kuhdo\Survey\Handlers\Question;

use Kuhdo\Survey\Handlers\Handler;
use Kuhdo\Survey\Question;

class DeleteQuestion extends Handler
{
    public function __invoke(Question $question)
    {
        $question->delete();

        return $question;
    }
}