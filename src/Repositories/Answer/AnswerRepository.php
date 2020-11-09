<?php


namespace Kuhdo\Survey\Repositories\Answer;

use Illuminate\Database\Eloquent\Collection;
use Kuhdo\Survey\Contracts\Voter\Voteable as Voter;
use Kuhdo\Survey\Question;

interface AnswerRepository
{
    /**
     * @return Collection
     */
    public function getAll() : Collection;

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id);

    /**
     * @param Voter $voter
     * @return mixed
     */
    public function getAllOfVoter(Voter $voter);

    /**
     * @param Voter $voter
     * @return mixed
     */
    public function getLatestOfVoter(Voter $voter);

    /**
     * @param Voter $voter
     * @param Question $question
     * @return mixed
     */
    public function getAllOfVoterAndQuestion(Voter $voter, Question $question);

    /**
     * @param Voter $voter
     * @param Question $question
     * @return mixed
     */
    public function getLatestOfVoterAndQuestion(Voter $voter, Question $question);
}
