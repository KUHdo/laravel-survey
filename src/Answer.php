<?php

namespace KUHdo\Survey;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Answer
 * @package KUHdo\Survey
 */
class Answer extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'answers';

    protected $fillable = [
        'type',
        'value',
        'created_at',
        'updated_at',
        'model_type',
        'model_id'
    ];

    protected $guarded = ['id'];

    /**
     * Get the question that owns the answer
     */
    public function question()
    {
        return $this->belongsTo('KUHdo\Survey\Question', 'question_id');
    }

    /**
     * Get the owning answerable model
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function model()
    {
        return $this->morphTo();
    }
}
