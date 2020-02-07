<?php

namespace Kuhdo\Survey\Tests\Traits;

use Illuminate\Database\Eloquent\Collection;
use Kuhdo\Survey\Answer;
use Kuhdo\Survey\Question;

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
            'model_type' => 'Model',
            'model_id' => 0,
        ];

        $answer = new Answer(array_merge($default, $attributes));

        return $answer;
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

        $answers->each(function ($answer) use ($question) {
            /** @var Answer $answer */
            $answer->question()->associate($question);
            $answer->save();
        });

        return $answers;
    }
}