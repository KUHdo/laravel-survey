<?php

namespace KUHdo\Survey\Handlers\Answer;

use Illuminate\Database\Eloquent\Collection;
use KUHdo\Survey\Handlers\Handler;
use KUHdo\Survey\Models\Answer;

class IndexAnswer extends Handler
{
    /**
     * Small index answer handler for use in controller actions
     */
    public function __invoke(): Collection|array
    {
        return Answer::all();
    }
}
