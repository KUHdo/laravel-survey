<?php

namespace KUHdo\Survey;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Question
 * @package KUHdo\Survey
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
        'created_at',
        'updated_at'
    ];

    protected $guarded = ['id'];

    /**
     * Get the survey that owns the question
     */
    public function survey()
    {
        return $this->belongsTo('KUHdo\Survey\Survey', 'survey_id');
    }

    /**
     * Get the answers for the question
     */
    public function answers()
    {
        return $this->hasMany('KUHdo\Survey\Answer');
    }
}
