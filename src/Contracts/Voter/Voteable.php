<?php

namespace KUHdo\Survey\Contracts\Voter;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface Voteable
{
    public function answers(): MorphMany;
}
