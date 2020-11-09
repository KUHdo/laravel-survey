<?php

namespace Kuhdo\Survey\Handlers\Question;

use Kuhdo\Survey\Question;
use Kuhdo\Survey\Handlers\Handler;

class IndexQuestion extends Handler
{
    public function __invoke()
    {
        return Question::all();
    }
}
