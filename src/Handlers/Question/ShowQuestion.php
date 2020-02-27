<?php

namespace Kuhdo\Survey\Handlers\Question;

use Kuhdo\Survey\Question;
use Kuhdo\Survey\Handlers\Handler;

class ShowQuestion extends Handler
{
    public function __invoke(Question $question)
    {
        return $question;
    }
}