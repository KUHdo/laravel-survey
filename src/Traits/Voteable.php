<?php

namespace KUHdo\Survey\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Voteable
{
    public function answers(): MorphMany
    {
        return $this->morphMany('KUHdo\Survey\Answer', 'model');
    }
}
