<?php


namespace KUHdo\Survey\Repositories\Question;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use KUHdo\Survey\Models\Answer;
use KUHdo\Survey\Contracts\Voter\Voteable as Voter;
use KUHdo\Survey\Models\Question;
use KUHdo\Survey\Models\Survey;

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
     * @param int $id
     * @return Question|null
     */
    public function getById(int $id): ?Question
    {
        return Question::find($id);
    }


    /**
     * @param int $id
     * @return Question|null
     */
    public function getByIdWithAnswers(int $id): ?Question
    {
        return Question::with('answers')
            ->where('id', '=', $id)
            ->first();
    }


    /**
     * @param int $id
     * @param Voter $voter
     * @return Question|null
     */
    public function getByIdWithAnswersOfVoter(int $id, Voter $voter): ?Question
    {
        return Question::with([
            'answers' => fn (HasMany $query): HasMany =>  $query->where('model_id', '=', $voter->id)->latest()
        ])->where('id', '=', $id)
          ->first();
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
        return Question::with([
            'answers' => fn (HasMany $query): HasMany => $query->where('model_id', '=', $voter->id)->latest()
        ])->where('survey_id', '=', $survey->id)
          ->get();
    }
}
