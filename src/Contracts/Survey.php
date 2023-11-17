<?php

namespace KUHdo\Survey\Contracts;

interface Survey
{
    /**
     * Eloquent wrapper or anything that resolves to
     * an survey
     */
    public static function findOrFailById(int $id): self;
}
