<?php

namespace Kuhdo\Survey\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Voteable
{
    public function answers(): MorphMany
    {
        return $this->morphMany('Kuhdo\Survey\Answer', 'model');
    }
}