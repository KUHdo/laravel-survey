<?php

namespace KUHdo\Survey\Traits;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use \Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

trait HasPackageFactory
{
    use HasFactory;

    /**
     * @return Factory
     */
    protected static function newFactory(): Factory
    {
        $package = Str::before(get_called_class(), 'Models\\');
        $modelName = Str::after(get_called_class(), 'Models\\');
        $path = $package.'Database\\Factories\\'.$modelName.'Factory';

        return $path::new();
    }
}