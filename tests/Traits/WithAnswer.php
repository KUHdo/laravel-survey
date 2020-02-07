<?php

namespace Kuhdo\Survey\Tests\Traits;

use Illuminate\Database\Eloquent\Collection;
use Kuhdo\Survey\Answer;
use Kuhdo\Survey\Question;
use Kuhdo\Survey\Tests\User;

/**
 * Trait WithAnswer
 * @package Kuhdo\Survey\Tests\Traits
 */
trait WithAnswer
{
    use WithQuestion;

    /**
     * @param array $attributes
     * @return Answer
     */
    function makeAnswer($attributes = [])
    {
        $default = [
            'value' => 'Test',
            'type' => 'Test',
        ];

        return new Answer(array_merge($default, $attributes));
    }

    /**
     * @param int $count
     * @param array $attributes
     * @return Collection
     */
    function makeAnswers($count = 1, $attributes = [])
    {
        $answers = new Collection();

        for ($i = 0; $i < $count; $i++) {
            $answers->push($this->makeAnswer($attributes));
        }

        return $answers;
    }

    /**
     * @param array $attributes
     * @return Answer
     */
    function createAnswer($attributes = [])
    {
        $answer = $this->makeAnswer($attributes);

        $question = $this->firstOrCreateQuestion($attributes['question_id'] ?? null);
        $answer->question()->associate($question);

        $user = User::create();
        $answer->model()->associate($user);

        $answer->save();

        return $answer;
    }

    /**
     * @param int $count
     * @param array $attributes
     * @return Collection
     */
    function createAnswers($count = 1, $attributes = [])
    {
        $answers = $this->makeAnswers($count, $attributes);

        $question = $this->firstOrCreateQuestion($attributes['question_id'] ?? null);
        $user = User::create();

        $answers->each(function ($answer) use ($question, $user) {
            /** @var Answer $answer */
            $answer->question()->associate($question);
            $answer->model()->associate($user);
            $answer->save();
        });

        return $answers;
    }
}