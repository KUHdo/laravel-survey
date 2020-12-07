<?php


namespace KUHdo\Survey\Repositories\Question;

use Illuminate\Database\Eloquent\Collection;
use KUHdo\Survey\Contracts\Voter\Voteable as Voter;
use KUHdo\Survey\Survey;

interface QuestionRepository
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
     * @param $id
     * @return mixed
     */
    public function getByIdWithAnswers($id);

    /**
     * @param $id
     * @param Voter $voter
     * @return mixed
     */
    public function getByIdWithAnswersOfVoter($id, Voter $voter);

    /**
     * @param Survey $survey
     * @return Collection
     */
    public function getAllOfSurvey(Survey $survey): Collection;

    /**
     * @param Survey $survey
     * @param Voter $voter
     * @return Collection
     */
    public function getAllOfSurveyWithAnswersOfVoter(Survey $survey, Voter $voter): Collection;
}
