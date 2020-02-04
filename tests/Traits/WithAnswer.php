<?php

namespace Kuhdo\Survey\Tests\Traits;

use Illuminate\Database\Eloquent\Collection;
use Kuhdo\Survey\Answer;

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
        $questionId = $attributes['question_id'] ?? $question = $this->createQuestion()->id;

        $default = [
            'value' => 'Test',
            'type' => 'Test',
            'question_id' => $questionId,
            'model_type' => 'Model',
            'model_id' => 0,
        ];

        $answer = new Answer(array_merge($default, $attributes));

        return $answer;
    }

    /**
     * @param array $attributes
     * @return Answer
     */
    function createAnswer($attributes = [])
    {
        $answer = $this->makeAnswer($attributes);

        $answer->save();

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
     * @param int $count
     * @param array $attributes
     * @return Collection
     */
    function createAnswers($count = 1, $attributes = [])
    {
        $answers = $this->makeAnswers($count, $attributes);

        $answers->each(function ($answer) {
            /** @var Answer $answer */
           $answer->save();
        });

        return $answers;
    }
}