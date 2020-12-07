<?php


namespace KUHdo\Survey\Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use KUHdo\Survey\Question;
use KUHdo\Survey\Tests\TestCase;
use KUHdo\Survey\Tests\Traits\WithQuestion;
use KUHdo\Survey\Tests\User;

class QuestionControllerTest extends TestCase
{
    use WithQuestion;
    use WithoutMiddleware;

    public function testIndex()
    {
        $user = User::create();

        $questions = $this->createQuestions(2);

        $response = $this->actingAs($user)->get('/survey/questions');

        $response->assertStatus(200);

        $this->assertEquals($questions->count(), count($response->json()));
    }

    public function testIndexAsGuest()
    {
        $response = $this->get('/survey/questions');

        $response->assertStatus(403);
    }

    public function testShow()
    {
        $user = User::create();

        $question = $this->createQuestion();

        $response = $this->actingAs($user)->get('/survey/questions/' . $question->id);

        $response->assertStatus(200);
        $this->assertEquals($question->id, $response->json()['id']);
    }

    public function testShowAsGuest()
    {
        $question = $this->createQuestion();

        $response = $this->get('/survey/questions/' . $question->id);

        $response->assertStatus(403);
    }

    public function testStore()
    {
        $survey = $this->createSurvey();
        $user = User::create();

        $data = array_merge($this->makeQuestion()->toArray(), ['survey_id' => $survey->id]);

        $response = $this->actingAs($user)->post('/survey/questions/', $data);

        $response->assertStatus(200);
        $this->assertTrue(Question::all()->count() > 0);
    }

    public function testStoreAsGuest()
    {
        $survey = $this->createSurvey();

        $data = array_merge($this->makeQuestion()->toArray(), ['survey_id' => $survey->id]);

        $response = $this->post('/survey/questions/', $data);

        $response->assertStatus(403);
    }

    public function testStoreWithInvalidData()
    {
        $this->createSurvey();
        $user = User::create();

        $response = $this->actingAs($user)->followingRedirects()->post('/survey/questions/', []);

        $response->assertStatus(404);
    }

    public function testUpdate()
    {
        $user = User::create();

        $updated = $this->makeQuestion(['question' => 'TestQuestion', 'category' => 'CategoryTest'])->toArray();

        $question = $this->createQuestion();

        $response = $this->actingAs($user)->put('/survey/questions/' . $question->id, $updated);
        $response->assertStatus(200);
        $this->assertEquals('TestQuestion', $response->json()['question']);
    }

    public function testUpdateAsGuest()
    {
        $updated = $this->makeQuestion(['question' => 'TestQuestion', 'category' => 'CategoryTest'])->toArray();

        $question = $this->createQuestion();

        $response = $this->put('/survey/questions/' . $question->id, $updated);

        $response->assertStatus(403);
    }

    public function testUpdateWithInvalidData()
    {
        $user = User::create();

        $question = $this->createQuestion();

        $response = $this->actingAs($user)->followingRedirects()->put('/survey/questions/' . $question->id, []);

        $response->assertStatus(404);
    }

    public function testDelete()
    {
        $user = User::create();

        $question = $this->createQuestion();

        $response = $this->actingAs($user)->delete('/survey/questions/' . $question->id);

        $response->assertStatus(200);
        $this->assertFalse($question->exists());
    }

    public function testDeleteAsGuest()
    {
        $question = $this->createQuestion();

        $response = $this->delete('/survey/questions/' . $question->id);

        $response->assertStatus(403);
        $this->assertTrue($question->exists());
    }
}
