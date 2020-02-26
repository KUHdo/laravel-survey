<?php

namespace Kuhdo\Survey\Handlers\Answer;

use Kuhdo\Survey\Answer;
use Kuhdo\Survey\Handlers\Handler;

class StoreAnswer extends Handler
{
    public function __invoke()
    {
        $this->authorize('create', Answer::class);

        return Answer::all();
    }
}