<?php

namespace KUHdo\Survey\Contracts;

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
