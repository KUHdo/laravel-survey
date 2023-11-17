<?php

namespace KUHdo\Survey\Repositories\Question;

use Illuminate\Database\Eloquent\Collection;
use KUHdo\Survey\Contracts\Voter\Voteable as Voter;
use KUHdo\Survey\Models\Question;
use KUHdo\Survey\Models\Survey;

interface QuestionRepository
{
    /**
     * @see EloquentQuestionRepository::getAll()
     */
    public function getAll(): Collection;

    /**
     * @see EloquentQuestionRepository::getById()
     */
    public function getById(int $id): ?Question;

    /**
     * @see EloquentQuestionRepository::getByIdWithAnswers()
     */
    public function getByIdWithAnswers(int $id): ?Question;

    /**
     * @see EloquentQuestionRepository::getByIdWithAnswersOfVoter()
     */
    public function getByIdWithAnswersOfVoter(int $id, Voter $voter): ?Question;

    /**
     * @see EloquentQuestionRepository::getAllOfSurvey()
     */
    public function getAllOfSurvey(Survey $survey): Collection;

    /**
     * @see EloquentQuestionRepository::getAllOfSurveyWithAnswersOfVoter()
     */
    public function getAllOfSurveyWithAnswersOfVoter(Survey $survey, Voter $voter): Collection;
}
