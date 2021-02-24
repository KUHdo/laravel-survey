<?php

namespace KUHdo\Survey\Handlers\Question;

use Exception;
use KUHdo\Survey\Handlers\Handler;
use KUHdo\Survey\Models\Question;

class DeleteQuestion extends Handler
{
    /**
     * Small delete question handler for use in controller actions
     *
     * @param Question $question
     * @return Question
     * @throws Exception
     */
    public function __invoke(Question $question): Question
    {
        $question->delete();

        return $question;
    }
}
