<?php


namespace Kuhdo\Survey\Repositories\Answer;

use Illuminate\Database\Eloquent\Builder;
use Kuhdo\Survey\Contracts\Voter\Voteable as Voter;
use Kuhdo\Survey\Question;

interface AnswerRepository
{
    /**
     * @param Voter $voter
     * @return mixed
     */
    function getAll(Voter $voter);

    /**
     * @param Voter $voter
     * @return mixed
     */
    function getLatest(Voter $voter);

    /**
     * @param Voter $voter
     * @param Question $question
     * @return mixed
     */
    function getAllOfQuestion(Voter $voter, Question $question);

    /**
     * @param Voter $voter
     * @param Question $question
     * @return mixed
     */
     function getLatestOfQuestion(Voter $voter, Question $question);
}