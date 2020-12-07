<?php

namespace KUHdo\Survey;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Survey
 * @package KUHdo\Survey
 */
class Survey extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'surveys';

    protected $fillable = [
        'title',
        'created_at',
        'updated_at',
    ];

    protected $guarded = ['id'];

    /**
     * Get the questions for the survey
     */
    public function questions()
    {
        return $this->hasMany('KUHdo\Survey\Question');
    }
}
