<?php

namespace KUHdo\Survey\Repositories\Question;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use KUHdo\Survey\Contracts\Voter\Voteable as Voter;
use KUHdo\Survey\Models\Question;
use KUHdo\Survey\Models\Survey;

class EloquentQuestionRepository implements QuestionRepository
{
    public function getAll(): Collection
    {
        return Question::all();
    }

    public function getById(int $id): ?Question
    {
        return Question::find($id);
    }

    public function getByIdWithAnswers(int $id): ?Question
    {
        return Question::with('answers')
            ->where('id', '=', $id)
            ->first();
    }

    public function getByIdWithAnswersOfVoter(int $id, Voter $voter): ?Question
    {
        return Question::with([
            'answers' => fn (HasMany $query): HasMany => $query->where('model_id', '=', $voter->id)->latest(),
        ])->where('id', '=', $id)
            ->first();
    }

    public function getAllOfSurvey(Survey $survey): Collection
    {
        return Question::all()->where('survey_id', $survey->id);
    }

    public function getAllOfSurveyWithAnswersOfVoter(Survey $survey, Voter $voter): Collection
    {
        return Question::with([
            'answers' => fn (HasMany $query): HasMany => $query->where('model_id', '=', $voter->id)->latest(),
        ])->where('survey_id', '=', $survey->id)
            ->get();
    }
}
