<?php

namespace KUHdo\Survey\Handlers\Answer;

use Illuminate\Database\Eloquent\Collection;
use KUHdo\Survey\Models\Answer;
use KUHdo\Survey\Handlers\Handler;

class IndexAnswer extends Handler
{
    /**
     * Small index answer handler for use in controller actions
     *
     * @return Collection|array
     */
    public function __invoke(): Collection|array
    {
        return Answer::all();
    }
}
