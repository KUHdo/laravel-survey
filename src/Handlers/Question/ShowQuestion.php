<?php

namespace KUHdo\Survey\Handlers\Question;

use KUHdo\Survey\Models\Question;
use KUHdo\Survey\Handlers\Handler;

class ShowQuestion extends Handler
{
    /**
     * Small show question handler for use in controller actions
     *
     * @param Question $question
     * @return Question
     */
    public function __invoke(Question $question): Question
    {
        return $question;
    }
}
