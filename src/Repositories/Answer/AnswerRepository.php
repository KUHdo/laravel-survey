<?php

namespace KUHdo\Survey\Repositories\Answer;

use Illuminate\Database\Eloquent\Collection;
use KUHdo\Survey\Contracts\Voter\Voteable as Voter;
use KUHdo\Survey\Models\Answer;
use KUHdo\Survey\Models\Question;

interface AnswerRepository
{
    /**
     * Returns all persisted answers
     *
     * @see EloquentAnswerRepository::getAll()
     */
    public function getAll(): Collection;

    /**
     * Returns one answer by id
     *
     * @see EloquentAnswerRepository::getById()
     */
    public function getById(int $id): Answer;

    /**
     * @return mixed
     *
     * @see EloquentAnswerRepository::getAllOfVoter()
     */
    public function getAllOfVoter(Voter $voter): Collection;

    /**
     * @return mixed
     *
     * @see EloquentAnswerRepository::getLatestOfVoter()
     */
    public function getLatestOfVoter(Voter $voter): Answer;

    /**
     * @return mixed
     *
     * @see EloquentAnswerRepository::getAllOfVoterAndQuestion()
     */
    public function getAllOfVoterAndQuestion(Voter $voter, Question $question): Collection;

    /**
     * @return mixed
     *
     * @see EloquentAnswerRepository::getLatestOfVoterAndQuestion()
     */
    public function getLatestOfVoterAndQuestion(Voter $voter, Question $question): Answer;
}
