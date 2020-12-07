<?php

namespace KUHdo\Survey\Handlers\Answer;

use KUHdo\Survey\Answer;
use KUHdo\Survey\Handlers\Handler;

class ShowAnswer extends Handler
{
    public function __invoke(Answer $answer)
    {
        return $answer;
    }
}
