<?php

namespace Kuhdo\Survey\Tests;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Kuhdo\Survey\Tests\Traits\WithAnswer;

class VoterTest extends TestCase
{
    use WithAnswer;

    /**
     * Should be correct object type of MorphMany
     */
    public function testVoterIsAnswerable()
    {
        $user = new User();
        $this->assertInstanceOf(MorphMany::class, $user->answers());
    }

    /**
     * Should assign an answer to a voter (User)
     */
    public function testAssociateAnswerWithVoter()
    {
        /** @var User $user */
        $user = User::create();
        $answer = $this->makeAnswer();

        $answer->question()->associate($this->createQuestion());

        $answer->model()->associate($user);
        $answer->save();

        $this->assertTrue($answer->model()->first()->is($user));
        $this->assertTrue($user->answers()->first()->is($answer));
    }
}
