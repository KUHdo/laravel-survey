<?php

namespace KUHdo\Survey\Handlers\Question;

use KUHdo\Survey\Question;
use KUHdo\Survey\Handlers\Handler;

class ShowQuestion extends Handler
{
    public function __invoke(Question $question)
    {
        return $question;
    }
}
