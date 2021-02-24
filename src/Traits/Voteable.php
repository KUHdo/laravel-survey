<?php

namespace KUHdo\Survey\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Voteable
{
    /**
     * All related answers of a voter
     *
     * @return MorphMany
     */
    public function answers(): MorphMany
    {
        return $this->morphMany('KUHdo\Survey\Answer', 'model');
    }
}
