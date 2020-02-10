<?php

namespace Kuhdo\Survey\Tests\Unit\Answer;


use Carbon\Carbon;
use Kuhdo\Survey\Answer;
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

        $firstAnswer = $this->createAnswer();
        $firstAnswer->model()->associate($user);
        $firstAnswer->save();

        $latestAnswer = $this->createAnswer();
        $latestAnswer->model()->associate($user);
        $latestAnswer->created_at = Carbon::now()->addMinute();
        $latestAnswer->save();

        $this->assertTrue($latestAnswer->is($this->answerRepo->getLatest($user)));
    }

    /**
     * Should fetch latest answer of certain question
     */
    public function testGetLatestAnswerOfUserForCertainQuestion()
    {
        /** @var User $user */
        $user = User::create();
        $question = $this->createQuestion();

        $firstAnswer = $this->createAnswer([
            'question_id' => $question->id
        ]);
        $firstAnswer->model()->associate($user);
        $firstAnswer->save();


        /* Create latest answer of certain question */
        $latestAnswerOfQuestion = $this->createAnswer([
            'question_id' => $question->id
        ]);
        $latestAnswerOfQuestion->model()->associate($user);
        $latestAnswerOfQuestion->created_at = Carbon::now()->addMinute();
        $latestAnswerOfQuestion->save();


        /* Create latest answer not related to mentioned question */
        $latestAnswerOfAll = $this->createAnswer();
        $latestAnswerOfAll->model()->associate($user);
        $latestAnswerOfAll->created_at = Carbon::now()->addHour();
        $latestAnswerOfAll->save();

        $this->assertTrue($latestAnswerOfAll->is($this->answerRepo->getLatest($user)));
        $this->assertTrue($latestAnswerOfQuestion->is($this->answerRepo->getLatestOfQuestion($user, $question)));
    }
}
