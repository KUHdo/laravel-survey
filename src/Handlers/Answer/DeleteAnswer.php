<?php

namespace KUHdo\Survey\Handlers\Answer;

use Exception;
use KUHdo\Survey\Handlers\Handler;
use KUHdo\Survey\Models\Answer;

class DeleteAnswer extends Handler
{
    /**
     * Small delete answer handler for use in controller actions
     *
     * @throws Exception
     */
    public function __invoke(Answer $answer): Answer
    {
        $answer->delete();

        return $answer;
    }
}
