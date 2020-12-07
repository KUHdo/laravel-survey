<?php

namespace KUHdo\Survey\Handlers\Answer;

use Illuminate\Support\Facades\Auth;
use KUHdo\Survey\Answer;
use KUHdo\Survey\Handlers\Handler;
use KUHdo\Survey\Requests\AnswerRequest;

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
