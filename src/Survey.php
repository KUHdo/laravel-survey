<?php

namespace Kuhdo\Survey;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Survey
 * @package Kuhdo\Survey
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
        return $this->hasMany('Kuhdo\Survey\Question');
    }
}
