<?php


namespace KUHdo\Survey\Repositories\Answer;

use Illuminate\Database\Eloquent\Collection;
use KUHdo\Survey\Models\Answer;
use KUHdo\Survey\Contracts\Voter\Voteable as Voter;
use KUHdo\Survey\Models\Question;

interface AnswerRepository
{
    /**
     * Returns all persisted answers
     *
     * @return Collection
     * @see EloquentAnswerRepository::getAll()
     */
    public function getAll() : Collection;

    /**
     * Returns one answer by id
     *
     * @param int $id
     * @return Answer
     * @see EloquentAnswerRepository::getById()
     */
    public function getById(int $id): Answer;

    /**
     * @param Voter $voter
     * @return mixed
     * @see EloquentAnswerRepository::getAllOfVoter()
     */
    public function getAllOfVoter(Voter $voter): Collection;

    /**
     * @param Voter $voter
     * @return mixed
     * @see EloquentAnswerRepository::getLatestOfVoter()
     */
    public function getLatestOfVoter(Voter $voter): Answer;

    /**
     * @param Voter $voter
     * @param Question $question
     * @return mixed
     * @see EloquentAnswerRepository::getAllOfVoterAndQuestion()
     */
    public function getAllOfVoterAndQuestion(Voter $voter, Question $question): Collection;

    /**
     * @param Voter $voter
     * @param Question $question
     * @return mixed
     * @see EloquentAnswerRepository::getLatestOfVoterAndQuestion()
     */
    public function getLatestOfVoterAndQuestion(Voter $voter, Question $question): Answer;
}
