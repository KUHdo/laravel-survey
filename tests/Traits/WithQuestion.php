<?php

namespace KUHdo\Survey\Tests\Traits;

use Illuminate\Database\Eloquent\Collection;
use KUHdo\Survey\Models\Question;

/**
 * Trait WithQuestion
 * @package KUHdo\Survey\Tests\Traits
 */
trait WithQuestion
{
    use WithSurvey;

    /**
     * @param array $attributes
     * @return Question
     */
    protected function makeQuestion($attributes = [])
    {
        $default = [
            'question' => 'Test',
            'category' => 'Test'
        ];

        $question = new Question(array_merge($default, $attributes));

        return $question;
    }

    /**
     * @param int $count
     * @param array $attributes
     * @return Collection
     */
    protected function makeQuestions($count = 1, $attributes = [])
    {
        $questions = new Collection();

        for ($i = 0; $i < $count; $i++) {
            $questions->push($this->makeQuestion($attributes));
        }

        return $questions;
    }

    /**
     * @param array $attributes
     * @return Question
     */
    protected function createQuestion($attributes = [])
    {
        $question = $this->makeQuestion($attributes);

        $survey = $this->firstOrCreateSurvey($attributes['survey_id'] ?? null);
        $question->survey()->associate($survey);

        $question->save();

        return $question;
    }

    /**
     * @param int $id
     * @param array $attributes
     * @return Question
     */
    protected function firstOrCreateQuestion($id, $attributes = [])
    {
        $question = isset($id) ?
            Question::firstOrCreate(['id' => $id], $attributes) :
            $this->createQuestion($attributes);

        return $question;
    }

    /**
     * @param int $count
     * @param array $attributes
     * @return Collection
     */
    protected function createQuestions($count = 1, $attributes = [])
    {
        $questions = $this->makeQuestions($count, $attributes);

        $survey = $this->firstOrCreateSurvey($attributes['survey_id'] ?? null);

        $questions->each(function ($question) use ($survey) {
            /** @var Question $question */
            $question->survey()->associate($survey);
            $question->save();
        });

        return $questions;
    }
}
