<?php

namespace KUHdo\Survey\Tests;

use KUHdo\Survey\Contracts\Voter\Voteable as VoteableContract;
use KUHdo\Survey\Traits\Voteable;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements VoteableContract
{
    use Voteable;

    /**
     * @var string
     */
    protected $table = 'users';
}
