<?php


namespace Kuhdo\Survey\Repositories\Question;

use Illuminate\Database\Eloquent\Collection;
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
            $query->where('model_id', '=', $voter->id);
        }])->where('id', '=', $id)->first();
    }

    /**
     * @param Survey $survey
     * @return mixed
     */
    function getAllOfSurvey(Survey $survey)
    {
        return Question::all()->where('survey_id', $survey->id);
    }
}