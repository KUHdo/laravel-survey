<?php


namespace KUHdo\Survey\Repositories\Answer;

use Illuminate\Database\Eloquent\Collection;
use KUHdo\Survey\Answer;
use KUHdo\Survey\Contracts\Voter\Voteable as Voter;
use KUHdo\Survey\Question;

class EloquentAnswerRepository implements AnswerRepository
{
    /**
     * @return mixed|void
     */
    public function getAll() : Collection
    {
        return Answer::all();
    }

    /**
     * @param $id
     * @return mixed|void
     */
    public function getById($id)
    {
        return Answer::find($id);
    }

    /**
     * @param Voter $voter
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    private function getAllBuilder(Voter $voter)
    {
        return $voter->answers();
    }

    /**
     * @param Voter $voter
     * @return mixed
     */
    public function getAllOfVoter(Voter $voter)
    {
        return $this->getAllBuilder($voter)->getResults();
    }

    /**
     * @param Voter $voter
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\MorphMany|mixed|object|null
     */
    public function getLatestOfVoter(Voter $voter)
    {
        return $this->getAllBuilder($voter)->latest()->first();
    }

    /**
     * @param Voter $voter
     * @param Question $question
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    private function getAllOfQuestionBuilder(Voter $voter, Question $question)
    {
        return $this->getAllBuilder($voter)->where('question_id', '=', $question->id);
    }

    /**
     * @param Voter $voter
     * @param Question $question
     * @return mixed
     */
    public function getAllOfVoterAndQuestion(Voter $voter, Question $question)
    {
        return $this->getAllOfQuestionBuilder($voter, $question)->getResults();
    }

    /**
     * @param Voter $voter
     * @param Question $question
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\MorphMany|mixed|object|null
     */
    public function getLatestOfVoterAndQuestion(Voter $voter, Question $question)
    {
        return $this->getAllOfQuestionBuilder($voter, $question)->latest()->first();
    }
}
