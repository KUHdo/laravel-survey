<?php

namespace KUHdo\Survey\Handlers\Survey;

use KUHdo\Survey\Handlers\Handler;
use KUHdo\Survey\Survey;

class IndexSurvey extends Handler
{
    public function __invoke()
    {
        return Survey::all();
    }
}
