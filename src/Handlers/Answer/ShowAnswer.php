<?php

namespace KUHdo\Survey\Handlers\Answer;

use KUHdo\Survey\Handlers\Handler;
use KUHdo\Survey\Models\Answer;

class ShowAnswer extends Handler
{
    /**
     * Small show answer handler for use in controller actions
     */
    public function __invoke(Answer $answer): Answer
    {
        return $answer;
    }
}
