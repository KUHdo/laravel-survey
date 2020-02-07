<?php

namespace Kuhdo\Survey;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Question
 * @package Kuhdo\Survey
 */
class Question extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'questions';

    protected $fillable = [
        'category',
        'question',
    ];

    protected $guarded = ['id'];

    /**
     * Get the survey that owns the question
     */
    public function survey()
    {
        return $this->belongsTo('Kuhdo\Survey\Survey', 'survey_id');
    }

    /**
     * Get the answers for the question
     */
    public function answers()
    {
        return $this->hasMany('Kuhdo\Survey\Answer');
    }
}
