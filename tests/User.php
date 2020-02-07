<?php

namespace Kuhdo\Survey\Tests;

use Illuminate\Database\Eloquent\Model;
use Kuhdo\Survey\Traits\Voter;

class User extends Model
{
    use Voter;

    protected $table = 'users';
}