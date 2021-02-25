<?php

namespace KUHdo\Survey\Contracts;

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
