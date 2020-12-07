<?php

namespace KUHdo\Survey\Handlers\Answer;

use KUHdo\Survey\Answer;
use KUHdo\Survey\Handlers\Handler;

class IndexAnswer extends Handler
{
    public function __invoke()
    {
        return Answer::all();
    }
}
