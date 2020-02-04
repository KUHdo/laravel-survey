<?php

namespace Kuhdo\Survey;

use Illuminate\Database\Eloquent\Model;

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
        'question_id',
        'model_type',
        'model_id'
    ];
}
