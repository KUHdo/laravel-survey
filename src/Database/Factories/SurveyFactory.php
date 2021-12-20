<?php

namespace KUHdo\Survey\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use KUHdo\Survey\Models\Survey;

class SurveyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Survey::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'title' => 'Test'
        ];
    }
}