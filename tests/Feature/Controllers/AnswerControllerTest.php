<?php


namespace Kuhdo\Survey\Tests\Feature\Controllers;


use Kuhdo\Survey\Answer;
use Kuhdo\Survey\Tests\TestCase;
use Kuhdo\Survey\Tests\Traits\WithAnswer;
use Kuhdo\Survey\Tests\User;

class AnswerControllerTest extends TestCase
{
    use WithAnswer;

    public function testIndex()
    {
        $user = User::create();

        $answers = $this->createAnswers(2);

        $response = $this->actingAs($user)->get('/survey/answers');

        $response->assertStatus(200);

        $this->assertEquals($answers->count(), count($response->json()));
    }

    public function testIndexAsGuest()
    {
        $response = $this->get('/survey/answers');

        $response->assertStatus(403);
    }

    public function testShowAsOwner()
    {
        $user = User::create();
        $answer = $this->createAnswerWithUser($user);

        var_dump('/survey/answers/' . $answer->id);

        $response = $this->actingAs($user)->get('/survey/answers/' . $answer->id);

        $response->assertStatus(200);
        $this->assertEquals($answer->id, $response['id']);
    }

    public function testShowAsGuest()
    {
        $answer = $this->createAnswer();

        $response = $this->get('/survey/answers/' . $answer->id);

        $response->assertStatus(403);
    }

    public function testStore()
    {
        $response = $this->actingAs($this->user)->post('/survey/answers', $this->makeAnswer()->toArray());

    }
}