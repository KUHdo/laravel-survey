<?php

namespace KUHdo\Survey\Handlers\Answer;

use KUHdo\Survey\Models\Answer;
use KUHdo\Survey\Handlers\Handler;

class ShowAnswer extends Handler
{
    /**
     * Small show answer handler for use in controller actions
     *
     * @param Answer $answer
     * @return Answer
     */
    public function __invoke(Answer $answer): Answer
    {
        return $answer;
    }
}
