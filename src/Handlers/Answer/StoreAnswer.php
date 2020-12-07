<?php

namespace KUHdo\Survey\Handlers\Answer;

use Illuminate\Support\Facades\Auth;
use KUHdo\Survey\Answer;
use KUHdo\Survey\Handlers\Handler;
use KUHdo\Survey\Question;
use KUHdo\Survey\Requests\AnswerRequest;

class StoreAnswer extends Handler
{
    public function __invoke(AnswerRequest $request)
    {
        $inputs = $request->input();

        $user = Auth::user();
        $question = Question::findOrFail($inputs['question_id']);

        $answer = new Answer($inputs);

        $answer->question()->associate($question);
        $answer->model()->associate($user);

        $answer->save();

        return $answer;
    }
}
