<?php


namespace Kuhdo\Survey\Repositories\Answer;

use Kuhdo\Survey\Contracts\Voter\Voteable as Voter;

interface AnswerRepository
{
    /**
     * @param Voter $voter
     */
    public function getLatest(Voter $voter);

}