<?php


namespace Kuhdo\Survey\Tests\Feature\Controllers;


use Kuhdo\Survey\Tests\TestCase;
use Kuhdo\Survey\Tests\Traits\WithAnswer;
use Kuhdo\Survey\Tests\User;

class AnswerControllerTest extends TestCase
{
    use WithAnswer;

    /**
     * @var User $user
     */
    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::create();
    }

    public function testIndex()
    {
        $answers = $this->createAnswers(2);

        $response = $this->actingAs($this->user)->get('/survey/answers');

        $response->assertStatus(200);
        $response->assertJson($answers->toArray());
    }
}