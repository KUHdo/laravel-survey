<?php

namespace KUHdo\Survey\Handlers\Survey;

use Illuminate\Database\Eloquent\Collection;
use KUHdo\Survey\Handlers\Handler;
use KUHdo\Survey\Models\Survey;

class IndexSurvey extends Handler
{
    /**
     * Small index survey handler for use in controller actions
     */
    public function __invoke(): Collection|array
    {
        return Survey::all();
    }
}
