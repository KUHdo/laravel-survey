<?php

namespace KUHdo\Survey\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
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