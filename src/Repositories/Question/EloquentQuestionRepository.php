<?php


namespace KUHdo\Survey\Repositories\Question;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use KUHdo\Survey\Answer;
use KUHdo\Survey\Contracts\Voter\Voteable as Voter;
use KUHdo\Survey\Question;
use KUHdo\Survey\Survey;

class EloquentQuestionRepository implements QuestionRepository
{
    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Question::all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return Question::find($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getByIdWithAnswers($id)
    {
        return Question::with('answers')->where('id', '=', $id)->first();
    }

    /**
     * @param $id
     * @param Voter $voter
     * @return mixed
     */
    public function getByIdWithAnswersOfVoter($id, Voter $voter)
    {
        return Question::with(['answers' => function ($query) use ($voter) {
            /** @var HasMany $query */
            $query->where('model_id', '=', $voter->id)->latest();
        }])->where('id', '=', $id)->first();
    }

    /**
     * @param Survey $survey
     * @return Collection
     */
    public function getAllOfSurvey(Survey $survey): Collection
    {
        return Question::all()->where('survey_id', $survey->id);
    }

    /**
     * @param Survey $survey
     * @param Voter $voter
     * @return Collection
     */
    public function getAllOfSurveyWithAnswersOfVoter(Survey $survey, Voter $voter): Collection
    {
        return Question::with(['answers' => function ($query) use ($voter) {
            /** @var HasMany $query */
            $query->where('model_id', '=', $voter->id)->latest();
        }])->where('survey_id', '=', $survey->id)->get();
    }
}
