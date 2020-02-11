<?php


namespace Kuhdo\Survey\Repositories\Answer;

use Kuhdo\Survey\Contracts\Voter\Voteable as Voter;
use Kuhdo\Survey\Question;

class EloquentAnswerRepository implements AnswerRepository
{
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
    public function getAll(Voter $voter)
    {
        return $this->getAllBuilder($voter)->getResults();
    }

    /**
     * @param Voter $voter
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\MorphMany|mixed|object|null
     */
    public function getLatest(Voter $voter)
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
    public function getAllOfQuestion(Voter $voter, Question $question)
    {
        return $this->getAllOfQuestionBuilder($voter, $question)->getResults();
    }

    /**
     * @param Voter $voter
     * @param Question $question
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\MorphMany|mixed|object|null
     */
    public function getLatestOfQuestion(Voter $voter, Question $question)
    {
        return $this->getAllOfQuestionBuilder($voter, $question)->latest()->first();
    }
}