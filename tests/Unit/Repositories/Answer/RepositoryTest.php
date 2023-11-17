<?php

namespace KUHdo\Survey\Tests\Unit\Repositories\Answer;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use KUHdo\Survey\Models\Answer;
use KUHdo\Survey\Models\Question;
use KUHdo\Survey\Models\Survey;
use KUHdo\Survey\Repositories\Answer\AnswerRepository;
use KUHdo\Survey\Repositories\Answer\EloquentAnswerRepository;
use KUHdo\Survey\Tests\TestCase;
use KUHdo\Survey\Tests\User;

class RepositoryTest extends TestCase
{
    private ?AnswerRepository $answerRepo;

    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->answerRepo = resolve(AnswerRepository::class);
    }

    /**
     * Should return Collection of Answer.
     *
     * @small
     *
     * @covers \KUHdo\Survey\Repositories\Answer\EloquentAnswerRepository
     */
    public function testReturnAnswerCollection()
    {
        Answer::factory()
            ->for(Question::factory()->for(Survey::factory()))
            ->count(3)
            ->create(['model_type' => 'test', 'model_id' => 1]);
        $this->assertInstanceOf(Collection::class, $this->answerRepo->getAll());
        $this->assertEquals(3, $this->answerRepo->getAll()->count());
    }

    /**
     * Should return Answer with certain id.
     *
     * @small
     *
     * @covers \KUHdo\Survey\Repositories\Answer\EloquentAnswerRepository
     */
    public function testReturnAnswerById()
    {
        $answer = Answer::factory()
            ->for(Question::factory()->for(Survey::factory()))
            ->create(['model_type' => 'test', 'model_id' => 1]);
        $this->assertTrue($answer->is($this->answerRepo->getById($answer->id)));
    }

    /**
     * Should bind correct concrete which is defined in Service.
     *
     * @small
     *
     * @covers \KUHdo\Survey\Repositories\Answer\EloquentAnswerRepository
     */
    public function testAnswerRepoShouldBeInstanceOfEloquentRepository()
    {
        $this->assertInstanceOf(EloquentAnswerRepository::class, $this->answerRepo);
    }

    /**
     * Should fetch latest answer of a voter (User).
     *
     * @small
     *
     * @covers \KUHdo\Survey\Repositories\Answer\EloquentAnswerRepository
     */
    public function testGetLatestAnswerOfUser()
    {
        /** @var User $user */
        $user = User::create();
        Answer::factory()
            ->for($user, 'votable')
            ->for(Question::factory()->for(Survey::factory()))
            ->create();
        $latestAnswer = Answer::factory()
            ->for($user, 'votable')
            ->for(Question::factory()->for(Survey::factory()))
            ->create();
        $latestAnswer->created_at = Carbon::now()->addMinute();
        $latestAnswer->save();

        $this->assertTrue($latestAnswer->is($this->answerRepo->getLatestOfVoter($user)));
    }

    /**
     * Should fetch latest answer of certain question.
     *
     * @small
     *
     * @covers \KUHdo\Survey\Repositories\Answer\EloquentAnswerRepository
     */
    public function testGetLatestAnswerOfUserForCertainQuestion()
    {
        /** @var User $user */
        $user = User::create();
        $question = Question::factory()->for(Survey::factory())
            ->create();
        Answer::factory()
            ->for($user, 'votable')
            ->for($question)
            ->create();
        /* Create latest answer of certain question */
        $latestAnswerOfQuestion = Answer::factory()
            ->for($question)
            ->for($user, 'votable')
            ->create();

        $latestAnswerOfQuestion->created_at = Carbon::now()->addMinute();
        $latestAnswerOfQuestion->save();
        /* Create latest answer not related to mentioned question */
        $latestAnswerOfAll = Answer::factory()
            ->for(Question::factory()->for(Survey::factory()))
            ->for($user, 'votable')
            ->create();
        $latestAnswerOfAll->created_at = Carbon::now()->addHour();
        $latestAnswerOfAll->save();

        $this->assertTrue(
            $latestAnswerOfAll->is($this->answerRepo->getLatestOfVoter($user))
        );

        $this->assertTrue(
            $latestAnswerOfQuestion->is($this->answerRepo->getLatestOfVoterAndQuestion($user, $question))
        );
    }
}
