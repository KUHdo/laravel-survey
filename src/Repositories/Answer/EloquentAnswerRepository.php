<?php


namespace KUHdo\Survey\Repositories\Answer;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use KUHdo\Survey\Models\Answer;
use KUHdo\Survey\Contracts\Voter\Voteable as Voter;
use KUHdo\Survey\Models\Question;

class EloquentAnswerRepository implements AnswerRepository
{
    /**
     * @return Collection
     */
    public function getAll() : Collection
    {
        return Answer::all();
    }

    /**
     * @param int $id
     * @return Answer
     */
    public function getById(int $id): Answer
    {
        return Answer::find($id);
    }

    /**
     * @param Voter $voter
     * @return MorphMany
     */
    private function getAllBuilder(Voter $voter): MorphMany
    {
        return $voter->answers();
    }

    /**
     * @param Voter $voter
     * @return Collection
     */
    public function getAllOfVoter(Voter $voter): Collection
    {
        return $this->getAllBuilder($voter)
            ->getResults();
    }

    /**
     * @param Voter $voter
     * @return Answer
     */
    public function getLatestOfVoter(Voter $voter): Answer
    {
        return $this->getAllBuilder($voter)
            ->latest()
            ->first();
    }

    /**
     * @param Voter $voter
     * @param Question $question
     * @return MorphMany
     */
    private function getAllOfQuestionBuilder(Voter $voter, Question $question): MorphMany
    {
        return $this->getAllBuilder($voter)
            ->where('question_id', '=', $question->id);
    }

    /**
     * @param Voter $voter
     * @param Question $question
     * @return Collection
     */
    public function getAllOfVoterAndQuestion(Voter $voter, Question $question): Collection
    {
        return $this->getAllOfQuestionBuilder($voter, $question)
            ->getResults();
    }

    /**
     * @param Voter $voter
     * @param Question $question
     * @return Answer
     */
    public function getLatestOfVoterAndQuestion(Voter $voter, Question $question): Answer
    {
        return $this->getAllOfQuestionBuilder($voter, $question)
            ->latest()
            ->first();
    }
}
