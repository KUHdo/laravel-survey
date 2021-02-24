<?php

namespace KUHdo\Survey\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface Answer
{
    /**
     * Eloquent wrapper or anything that resolves to
     * an Answer with columns
     *
     * @param int $id
     * @return Answer
     */
    public static function findOrFailById(int $id): self;
}
