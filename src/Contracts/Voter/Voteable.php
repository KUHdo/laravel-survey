<?php


namespace KUHdo\Survey\Contracts\Voter;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface Voteable
{
    /**
     * @return MorphMany
     */
    public function answers(): MorphMany;
}
