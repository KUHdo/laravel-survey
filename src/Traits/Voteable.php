<?php

namespace KUHdo\Survey\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use KUHdo\Survey\Models\Answer;

trait Voteable
{
    /**
     * All related answers of a voter
     *
     * @return MorphMany
     */
    public function answers(): MorphMany
    {
        return $this->morphMany(Answer::class, 'model');
    }
}
