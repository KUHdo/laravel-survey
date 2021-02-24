<?php

namespace KUHdo\Survey\Tests;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use KUHdo\Survey\Database\Factories\SurveyFactory;
use KUHdo\Survey\Models\Answer;
use KUHdo\Survey\Models\Question;
use KUHdo\Survey\Models\Survey;

class VoterTest extends TestCase
{
    /**
     * Should be correct object type of MorphMany
     *
     * @small
     * @covers \KUHdo\Survey\Tests\User
     */
    public function testVoterIsAnswerable()
    {
        $user = new User();
        $this->assertInstanceOf(MorphMany::class, $user->answers());
    }

    /**
     * Should assign an answer to a voter (User)
     *
     * @small
     * @covers User
     */
    public function testAssociateAnswerWithVoter()
    {
        /** @var User $user */
        $user = User::create();
        $answer = Answer::factory()
            ->for(Question::factory()->for(Survey::factory()))
            ->for($user, 'votable')
            ->create();

        $this->assertTrue($answer->votable()->first()->is($user));
        $this->assertTrue($user->answers()->first()->is($answer));
    }
}
