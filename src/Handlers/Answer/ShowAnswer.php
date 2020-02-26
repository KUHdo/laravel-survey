<?php

namespace Kuhdo\Survey\Handlers\Answer;

use Kuhdo\Survey\Answer;
use Kuhdo\Survey\Handlers\Handler;

class ShowAnswer extends Handler
{
    public function __invoke(Answer $answer)
    {
        $this->authorize('view', $answer);

        return $answer;
    }
}