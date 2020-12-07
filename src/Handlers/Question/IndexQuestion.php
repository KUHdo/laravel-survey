<?php

namespace KUHdo\Survey\Handlers\Question;

use KUHdo\Survey\Question;
use KUHdo\Survey\Handlers\Handler;

class IndexQuestion extends Handler
{
    public function __invoke()
    {
        return Question::all();
    }
}
