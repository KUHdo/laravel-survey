<?php

namespace Kuhdo\Survey\Tests\Traits;

use Illuminate\Database\Eloquent\Collection;
use Kuhdo\Survey\Question;

/**
 * Trait WithQuestion
 * @package Kuhdo\Survey\Tests\Traits
 */
trait WithQuestion
{
    use WithSurvey;

    /**
     * @param array $attributes
     * @return Question
     */
    function makeQuestion($attributes = [])
    {
        $surveyId = $attributes['survey_id'] ?? $survey = $this->createSurvey()->id;

        $default = [
            'question' => 'Test',
            'category' => 'Test',
            'survey_id' => $surveyId
        ];

        $question = new Question(array_merge($default, $attributes));

        return $question;
    }

    /**
     * @param array $attributes
     * @return Question
     */
    function createQuestion($attributes = [])
    {
        $question = $this->makeQuestion($attributes);

        $question->save();

        return $question;
    }

    /**
     * @param int $count
     * @param array $attributes
     * @return Collection
     */
    function makeQuestions($count = 1, $attributes = [])
    {
        $questions = new Collection();

        for ($i = 0; $i < $count; $i++) {
            $questions->push($this->makeQuestion($attributes));
        }

        return $questions;
    }

    /**
     * @param int $count
     * @param array $attributes
     * @return Collection
     */
    function createQuestions($count = 1, $attributes = [])
    {
        $questions = $this->makeQuestions($count, $attributes);

        $questions->each(function ($question) {
            /** @var Question $question */
           $question->save();
        });

        return $questions;
    }
}