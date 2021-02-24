<?php

namespace KUHdo\Survey\Handlers\Question;

use Illuminate\Database\Eloquent\Collection;
use KUHdo\Survey\Models\Question;
use KUHdo\Survey\Handlers\Handler;

class IndexQuestion extends Handler
{
    /**
     * Small index question handler for use in controller actions
     *
     * @return Collection|array
     */
    public function __invoke(): Collection|array
    {
        return Question::all();
    }
}
