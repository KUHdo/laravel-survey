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
    function getAll() : Collection;

    /**
     * @param $id
     * @return mixed
     */
    function getById($id);

    /**
     * @param Voter $voter
     * @return mixed
     */
    function getAllOfVoter(Voter $voter);

    /**
     * @param Voter $voter
     * @return mixed
     */
    function getLatestOfVoter(Voter $voter);

    /**
     * @param Voter $voter
     * @param Question $question
     * @return mixed
     */
    function getAllOfVoterAndQuestion(Voter $voter, Question $question);

    /**
     * @param Voter $voter
     * @param Question $question
     * @return mixed
     */
     function getLatestOfVoterAndQuestion(Voter $voter, Question $question);
}