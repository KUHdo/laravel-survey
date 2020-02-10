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

    public function testAnswerRepoShouldBeInstanceOfEloquentRepository()
    {
        $this->assertInstanceOf('Kuhdo\Survey\Repositories\Answer\EloquentAnswerRepository', $this->answerRepo);
    }

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
}
