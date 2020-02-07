<?php

namespace Kuhdo\Survey\Tests;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Kuhdo\Survey\Tests\Traits\WithAnswer;

class VoterTest extends TestCase
{
    use WithAnswer;

    public function testVoterIsAnswerable()
    {
        $user = new User();
        $this->assertInstanceOf(MorphMany::class, $user->answers());
    }

    public function testAssociateAnswerWithVoter()
    {
        /** @var User $user */
        $user = User::create();
        $answer = $this->makeAnswer();

        $answer->question()->associate($this->createQuestion());

        $answer->model()->associate($user);
        $answer->save();

        $this->assertEquals($answer->model()->first()->attributesToArray(), $user->attributesToArray());
        $this->assertEquals($user->answers()->first()->attributesToArray(), $answer->attributesToArray());
    }
}
