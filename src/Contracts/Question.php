<?php

namespace KUHdo\Survey\Contracts;

interface Question
{
    /**
     * Eloquent wrapper or anything that resolves to
     * an question
     *
     * @param int $id
     * @return Question
     */
    public static function findOrFailById(int $id): self;
}
