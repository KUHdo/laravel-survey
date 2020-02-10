<?php

namespace Kuhdo\Survey\Tests;

use Illuminate\Database\Eloquent\Model;
use Kuhdo\Survey\Contracts\Voter\Voteable as VoteableContract;
use Kuhdo\Survey\Traits\Voteable;

class User extends Model implements VoteableContract
{
    use Voteable;

    protected $table = 'users';
}