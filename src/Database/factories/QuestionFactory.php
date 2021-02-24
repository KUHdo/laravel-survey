<?php

namespace KUHdo\Survey\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use KUHdo\Survey\Models\Question;

class QuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Question::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'question' => 'Test',
            'category' => 'Test'
        ];
    }
}