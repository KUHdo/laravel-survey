<?php

namespace KUHdo\Survey\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use KUHdo\Survey\Models\Answer;

class AnswerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Answer::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'value' => 'Test',
            'type' => 'Test',
        ];
    }
}
