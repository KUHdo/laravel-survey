<?php

namespace Kuhdo\Survey\Handlers\Survey;

use Kuhdo\Survey\Handlers\Handler;
use Kuhdo\Survey\Survey;

class IndexSurvey extends Handler
{
    public function __invoke()
    {
        return Survey::all();
    }
}