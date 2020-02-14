<?php


namespace Kuhdo\Survey\Repositories\Question;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Kuhdo\Survey\Answer;
use Kuhdo\Survey\Contracts\Voter\Voteable as Voter;
use Kuhdo\Survey\Question;
use Kuhdo\Survey\Survey;

class EloquentQuestionRepository implements QuestionRepository
{
    /**
     * @return Collection
     */
    function getAll(): Collection
    {
        return Question::all();
    }

    /**
     * @param $id
     * @return mixed
     */
    function getById($id)
    {
        return Question::find($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    function getByIdWithAnswers($id)
    {
        return Question::with('answers')->where('id', '=', $id)->first();
    }

    /**
     * @param $id
     * @param Voter $voter
     * @return mixed
     */
    function getByIdWithAnswersOfVoter($id, Voter $voter)
    {
        return Question::with(['answers' => function($query) use ($voter) {
            /** @var HasMany $query */
            $query->where('model_id', '=', $voter->id)->latest();
        }])->where('id', '=', $id)->first();
    }

    /**
     * @param Survey $survey
     * @return Collection
     */
    function getAllOfSurvey(Survey $survey): Collection
    {
        return Question::all()->where('survey_id', $survey->id);
    }

    /**
     * @param Survey $survey
     * @param Voter $voter
     * @return Collection
     */
    function getAllOfSurveyWithAnswersOfVoter(Survey $survey, Voter $voter): Collection
    {
        return Question::with(['answers' => function($query) use ($voter) {
            /** @var HasMany $query */
            $query->where('model_id', '=', $voter->id)->latest();
        }])->where('survey_id', '=', $survey->id)->get();
    }
}