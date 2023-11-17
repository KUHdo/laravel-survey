<?php

namespace KUHdo\Survey\Handlers\Question;

use KUHdo\Survey\Handlers\Handler;
use KUHdo\Survey\Models\Question;

class ShowQuestion extends Handler
{
    /**
     * Small show question handler for use in controller actions
     */
    public function __invoke(Question $question): Question
    {
        return $question;
    }
}
