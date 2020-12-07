<?php

namespace KUHdo\Survey\Tests;

use Illuminate\Database\Eloquent\Model;
use KUHdo\Survey\Contracts\Voter\Voteable as VoteableContract;
use KUHdo\Survey\Traits\Voteable;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements VoteableContract
{
    use Voteable;

    protected $table = 'users';
}
