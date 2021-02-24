<?php

namespace KUHdo\Survey\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use KUHdo\Survey\Traits\HasPackageFactory;

/**
 * Class Answer
 * @package KUHdo\Survey
 */
class Answer extends Model
{
    use HasPackageFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'answers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'value',
        'created_at',
        'updated_at',
        'model_type',
        'model_id'
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Get the question that owns the answer
     */
    public function question()
    {
        return $this->belongsTo('KUHdo\Survey\Question', 'question_id');
    }

    /**
     * Get the owning answerable model.
     *
     * @return MorphTo
     */
    public function model(): MorphTo
    {
        return $this->morphTo();
    }
}
