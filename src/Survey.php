<?php

namespace Kuhdo\Survey;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'surveys';

    protected $fillable = [
        'title'
    ];
}
