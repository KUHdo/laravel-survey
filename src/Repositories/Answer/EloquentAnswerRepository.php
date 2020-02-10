<?php


namespace Kuhdo\Survey\Repositories\Answer;

use Kuhdo\Survey\Contracts\Voter\Voteable as Voter;

class EloquentAnswerRepository implements AnswerRepository
{

    public function getLatest(Voter $voter)
    {
        return $voter->answers()->latest()->first();
    }
}