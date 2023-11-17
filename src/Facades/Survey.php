<?php

namespace KUHdo\Survey\Facades;

use Illuminate\Support\Facades\Facade;

class Survey extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'survey';
    }
}
