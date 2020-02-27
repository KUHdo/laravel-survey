<?php


namespace Kuhdo\Survey\Tests\Feature\Controllers;


use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
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

        $response = $this->actingAs($user)->get('/survey/answers/' . $answer->id);

        $response->assertStatus(200);

        $this->assertEquals($answer->id, $response->json()['id']);
    }

    public function testShowAsGuest()
    {
        $answer = $this->createAnswer();

        $response = $this->get('/survey/answers/' . $answer->id);

        $response->assertStatus(403);
    }

    public function testStore()
    {
        $question = $this->createQuestion();
        $user = User::create();

        $data = array_merge($this->makeAnswer()->toArray(), ['question_id' => $question->id]);

        $response = $this->actingAs($user)->post('/survey/answers/', $data);
        $response->assertStatus(200);

        $this->assertTrue($user->answers()->first()->exists());
    }

    public function testStoreAsGuest()
    {
        $data = array_merge($this->makeAnswer()->toArray(), ['question_id' => 1]);

        $response = $this->post('/survey/answers', $data);

        $response->assertStatus(403);
    }

    public function testStoreWithInvalidData()
    {
        $user = User::create();
        $response = $this->actingAs($user)->followingRedirects()->post('/survey/answers', []);

        $response->assertStatus(404);
    }

    public function testUpdate()
    {
        $user = User::create();
        $answer = $this->createAnswerWithUser($user);

        $updated = $this->makeAnswer(['value' => '120', 'type' => 'string'])->toArray();

        $response = $this->actingAs($user)->put('/survey/answers/' . $answer->id, $updated);

        $response->assertStatus(200);

        $this->assertEquals('120', $response->json()['value']);
    }

    public function testUpdateAsNotOwner()
    {
        $user = User::create();
        $answer = $this->createAnswer();

        $updated = $this->makeAnswer(['value' => '120', 'type' => 'string'])->toArray();

        $response = $this->actingAs($user)->put('/survey/answers/' . $answer->id, $updated);

        $response->assertStatus(403);
    }

    public function testUpdateAsGuest()
    {
        $answer = $this->createAnswer();

        $updated = $this->makeAnswer(['value' => '120', 'type' => 'string'])->toArray();

        $response = $this->put('/survey/answers/' . $answer->id, $updated);

        $response->assertStatus(403);
    }

    public function testUpdateWithInvalidData()
    {
        $user = User::create();
        $answer = $this->createAnswerWithUser($user);

        $response = $this->actingAs($user)->followingRedirects()->put('/survey/answers/' . $answer->id, []);

        $response->assertStatus(404);
    }

    public function testDelete()
    {
        $user = User::create();
        $answer = $this->createAnswerWithUser($user);

        $response = $this->actingAs($user)->delete('/survey/answers/' . $answer->id);

        $response->assertStatus(200);

        $this->assertFalse($answer->exists());
    }

    public function testDeleteAsNotOwner()
    {
        $user = User::create();
        $answer = $this->createAnswer();

        $response = $this->actingAs($user)->delete('/survey/answers/' . $answer->id);

        $response->assertStatus(403);
        $this->assertTrue($answer->exists());
    }

    public function testDeleteAsGuest()
    {
        $answer = $this->createAnswer();

        $response = $this->delete('/survey/answers/' . $answer->id);

        $response->assertStatus(403);
        $this->assertTrue($answer->exists());
    }
}