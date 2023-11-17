<?php

namespace KUHdo\Survey\Handlers\Question;

use Illuminate\Database\Eloquent\Collection;
use KUHdo\Survey\Handlers\Handler;
use KUHdo\Survey\Models\Question;

class IndexQuestion extends Handler
{
    /**
     * Small index question handler for use in controller actions
     */
    public function __invoke(): Collection|array
    {
        return Question::all();
    }
}
