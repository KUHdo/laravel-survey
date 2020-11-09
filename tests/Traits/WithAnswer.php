<?php

namespace Kuhdo\Survey\Tests\Traits;

use Illuminate\Database\Eloquent\Collection;
use Kuhdo\Survey\Answer;
use Kuhdo\Survey\Contracts\Voter\Voteable as Voter;
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
    protected function makeAnswer($attributes = [])
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
    protected function makeAnswers($count = 1, $attributes = [])
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
    protected function createAnswer($attributes = [])
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
     * @param User $user
     * @param array $attributes
     * @return Answer
     */
    protected function createAnswerWithUser(User $user, $attributes = [])
    {
        $answer = $this->makeAnswer($attributes);

        $question = $this->firstOrCreateQuestion($attributes['question_id'] ?? null);

        $answer->question()->associate($question);
        $answer->model()->associate($user);

        $answer->save();

        return $answer;
    }

    /**
     * @param int $count
     * @param array $attributes
     * @return Collection
     */
    protected function createAnswers($count = 1, $attributes = [])
    {
        $answers = $this->makeAnswers($count, $attributes);

        $question = $this->firstOrCreateQuestion($attributes['question_id'] ?? null);
        $user = User::create();

        $answers->each(function ($answer) use ($question, $user, $attributes) {
            /** @var Answer $answer */
            $answer->question()->associate($question);
            $answer->model()->associate($user);
            $answer->save();
        });

        return $answers;
    }

    /**
     * @param User $user
     * @param int $count
     * @param array $attributes
     * @return Collection
     */
    protected function createAnswersWithUser(User $user, $count = 1, $attributes = [])
    {
        $answers = $this->makeAnswers($count, $attributes);

        $question = $this->firstOrCreateQuestion($attributes['question_id'] ?? null);

        $answers->each(function ($answer) use ($question, $user, $attributes) {
            /** @var Answer $answer */
            $answer->question()->associate($question);
            $answer->model()->associate($user);
            $answer->save();
        });

        return $answers;
    }
}
