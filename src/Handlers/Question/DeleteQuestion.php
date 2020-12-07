<?php

namespace KUHdo\Survey\Handlers\Question;

use KUHdo\Survey\Handlers\Handler;
use KUHdo\Survey\Question;

class DeleteQuestion extends Handler
{
    public function __invoke(Question $question)
    {
        $question->delete();

        return $question;
    }
}
