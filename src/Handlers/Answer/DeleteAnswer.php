<?php

namespace KUHdo\Survey\Handlers\Answer;

use Exception;
use KUHdo\Survey\Models\Answer;
use KUHdo\Survey\Handlers\Handler;

class DeleteAnswer extends Handler
{
    /**
     * Small delete answer handler for use in controller actions
     *
     * @param Answer $answer
     * @return Answer
     * @throws Exception
     */
    public function __invoke(Answer $answer): Answer
    {
        $answer->delete();

        return $answer;
    }
}
