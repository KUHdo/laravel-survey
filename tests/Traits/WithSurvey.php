<?php

namespace Kuhdo\Survey\Tests\Traits;

use Illuminate\Database\Eloquent\Collection;
use Kuhdo\Survey\Survey;

/**
 * Trait WithSurvey
 * @package Kuhdo\Survey\Tests\Traits
 */
trait WithSurvey
{
    /**
     * @param array $attributes
     * @return Survey
     */
    function makeSurvey($attributes = [])
    {
        $default = [
            'title' => 'Test'
        ];

        $survey = new Survey(array_merge($default, $attributes));

        return $survey;
    }

    /**
     * @param int $count
     * @param array $attributes
     * @return Collection
     */
    function makeSurveys($count = 1, $attributes = [])
    {
        $surveys = new Collection();

        for ($i = 0; $i < $count; $i++) {
            $surveys->push($this->makeSurvey($attributes));
        }

        return $surveys;
    }

    /**
     * @param array $attributes
     * @return Survey
     */
    function createSurvey($attributes = [])
    {
        $survey = $this->makeSurvey($attributes);

        $survey->save();

        return $survey;
    }

    /**
     * @param int $id
     * @param array $attributes
     * @return Survey
     */
    function firstOrCreateSurvey($id, $attributes = [])
    {
        $survey = isset($id) ?
            Survey::firstOrCreate(['survey_id' => $id], $attributes) :
            $this->createSurvey($attributes);

        return $survey;
    }

    /**
     * @param int $count
     * @param array $attributes
     * @return Collection
     */
    function createSurveys($count = 1, $attributes = [])
    {
        $surveys = $this->makeSurveys($count, $attributes);

        $surveys->each(function ($survey) {
            /** @var Survey $survey */
           $survey->save();
        });

        return $surveys;
    }
}