<?php

namespace KUHdo\Survey\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface Survey
{
    /**
     * Eloquent wrapper or anything that resolves to
     * an survey
     *
     * @param int $id
     * @return Survey
     */
    public static function findOrFailById(int $id): self;
}
