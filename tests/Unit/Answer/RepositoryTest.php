<?php

namespace Kuhdo\Survey\Tests\Unit\Answer;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Kuhdo\Survey\Repositories\Answer\AnswerRepository;
use Kuhdo\Survey\Tests\TestCase;
use Kuhdo\Survey\Tests\Traits\WithAnswer;
use Kuhdo\Survey\Tests\User;

class RepositoryTest extends TestCase
{
    use WithAnswer;

    /**
     * @var AnswerRepository
     */
    private $answerRepo;

    protected function setUp(): void
    {
        parent::setUp();

        $this->answerRepo = resolve(AnswerRepository::class);
    }

    /**
     * Should return Collection of Answer
     */
    public function testReturnAnswerCollection()
    {
        $this->createAnswers(3);

        $this->assertInstanceOf(Collection::class, $this->answerRepo->getAll());
        $this->assertEquals(3, $this->answerRepo->getAll()->count());
    }

    /**
     * Should return Answer with certain id
     */
    public function testReturnAnswerById()
    {
        $answer = $this->createAnswer();

        $this->assertTrue($answer->is($this->answerRepo->getById($answer->id)));
    }

    /**
     * Should bind correct concrete which is defined in Service
     */
    public function testAnswerRepoShouldBeInstanceOfEloquentRepository()
    {
        $this->assertInstanceOf('Kuhdo\Survey\Repositories\Answer\EloquentAnswerRepository', $this->answerRepo);
    }

    /**
     * Should fetch latest answer of a voter (User)
     */
    public function testGetLatestAnswerOfUser()
    {
        /** @var User $user */
        $user = User::create();

        $this->createAnswerWithUser($user);

        $latestAnswer = $this->createAnswerWithUser($user);
        $latestAnswer->created_at = Carbon::now()->addMinute();
        $latestAnswer->save();

        $this->assertTrue($latestAnswer->is($this->answerRepo->getLatestOfVoter($user)));
    }

    /**
     * Should fetch latest answer of certain question
     */
    public function testGetLatestAnswerOfUserForCertainQuestion()
    {
        /** @var User $user */
        $user = User::create();
        $question = $this->createQuestion();

        $this->createAnswerWithUser($user, [
            'question_id' => $question->id,
        ]);

        /* Create latest answer of certain question */
        $latestAnswerOfQuestion = $this->createAnswerWithUser($user, [
            'question_id' => $question->id
        ]);
        $latestAnswerOfQuestion->created_at = Carbon::now()->addMinute();
        $latestAnswerOfQuestion->save();

        /* Create latest answer not related to mentioned question */
        $latestAnswerOfAll = $this->createAnswerWithUser($user);
        $latestAnswerOfAll->created_at = Carbon::now()->addHour();
        $latestAnswerOfAll->save();

        $this->assertTrue($latestAnswerOfAll->is($this->answerRepo->getLatestOfVoter($user)));
        $this->assertTrue($latestAnswerOfQuestion->is($this->answerRepo->getLatestOfVoterAndQuestion($user, $question)));
    }
}
