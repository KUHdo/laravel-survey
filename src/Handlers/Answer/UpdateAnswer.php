<?php

namespace Kuhdo\Survey\Handlers\Answer;

use Illuminate\Support\Facades\Auth;
use Kuhdo\Survey\Answer;
use Kuhdo\Survey\Handlers\Handler;
use Kuhdo\Survey\Requests\AnswerRequest;

class UpdateAnswer extends Handler
{
    public function __invoke(AnswerRequest $request, Answer $answer)
    {
        $inputs = $request->input();

        $answer->fill($inputs);

        $answer->save();

        return $answer;
    }
}