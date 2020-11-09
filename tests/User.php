<?php

namespace Kuhdo\Survey\Tests;

use Illuminate\Database\Eloquent\Model;
use Kuhdo\Survey\Contracts\Voter\Voteable as VoteableContract;
use Kuhdo\Survey\Traits\Voteable;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements VoteableContract
{
    use Voteable;

    protected $table = 'users';
}
