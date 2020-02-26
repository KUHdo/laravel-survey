<?php

namespace Kuhdo\Survey\Handlers\Answer;

use Kuhdo\Survey\Answer;
use Kuhdo\Survey\Handlers\Handler;

class IndexAnswer extends Handler
{
    public function __invoke()
    {
        $this->authorize('viewAny', Answer::class);

        return Answer::all();
    }
}