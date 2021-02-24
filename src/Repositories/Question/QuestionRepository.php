<?php


namespace KUHdo\Survey\Repositories\Question;

use Illuminate\Database\Eloquent\Collection;
use KUHdo\Survey\Contracts\Voter\Voteable as Voter;
use KUHdo\Survey\Models\Question;
use KUHdo\Survey\Models\Survey;

interface QuestionRepository
{
    /**
     * @return Collection
     * @see EloquentQuestionRepository::getAll()
     */
    public function getAll() : Collection;

    /**
     * @param int $id
     * @return Question|null
     * @see EloquentQuestionRepository::getById()
     */
    public function getById(int $id): ?Question;

    /**
     * @param int $id
     * @return Question|null
     * @see EloquentQuestionRepository::getByIdWithAnswers()
     */
    public function getByIdWithAnswers(int $id): ?Question;

    /**
     * @param int $id
     * @param Voter $voter
     * @return Question|null
     * @see EloquentQuestionRepository::getByIdWithAnswersOfVoter()
     */
    public function getByIdWithAnswersOfVoter(int $id, Voter $voter): ?Question;

    /**
     * @param Survey $survey
     * @return Collection
     * @see EloquentQuestionRepository::getAllOfSurvey()
     */
    public function getAllOfSurvey(Survey $survey): Collection;

    /**
     * @param Survey $survey
     * @param Voter $voter
     * @return Collection
     * @see EloquentQuestionRepository::getAllOfSurveyWithAnswersOfVoter()
     */
    public function getAllOfSurveyWithAnswersOfVoter(Survey $survey, Voter $voter): Collection;
}
