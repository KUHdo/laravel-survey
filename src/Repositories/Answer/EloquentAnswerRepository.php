<?php

namespace KUHdo\Survey\Repositories\Answer;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use KUHdo\Survey\Contracts\Voter\Voteable as Voter;
use KUHdo\Survey\Models\Answer;
use KUHdo\Survey\Models\Question;

class EloquentAnswerRepository implements AnswerRepository
{
    public function getAll(): Collection
    {
        return Answer::all();
    }

    public function getById(int $id): Answer
    {
        return Answer::find($id);
    }

    private function getAllBuilder(Voter $voter): MorphMany
    {
        return $voter->answers();
    }

    public function getAllOfVoter(Voter $voter): Collection
    {
        return $this->getAllBuilder($voter)
            ->getResults();
    }

    public function getLatestOfVoter(Voter $voter): Answer
    {
        return $this->getAllBuilder($voter)
            ->latest()
            ->first();
    }

    private function getAllOfQuestionBuilder(Voter $voter, Question $question): MorphMany
    {
        return $this->getAllBuilder($voter)
            ->where('question_id', '=', $question->id);
    }

    public function getAllOfVoterAndQuestion(Voter $voter, Question $question): Collection
    {
        return $this->getAllOfQuestionBuilder($voter, $question)
            ->getResults();
    }

    public function getLatestOfVoterAndQuestion(Voter $voter, Question $question): Answer
    {
        return $this->getAllOfQuestionBuilder($voter, $question)
            ->latest()
            ->first();
    }
}
