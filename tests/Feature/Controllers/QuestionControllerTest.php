<?php


namespace KUHdo\Survey\Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use KUHdo\Survey\Models\Question;
use KUHdo\Survey\Models\Survey;
use KUHdo\Survey\Tests\TestCase;
use KUHdo\Survey\Tests\User;

class QuestionControllerTest extends TestCase
{
    use WithoutMiddleware;

    /**
     * Test for question controller action Index
     *
     * @covers \KUHdo\Survey\Controllers\QuestionController::index
     * @small
     */
    public function testIndex()
    {
        $user = User::create();
        $questions = Question::factory()
            ->count(2)
            ->for(Survey::factory())
            ->create();
        $response = $this->actingAs($user)
            ->get('/survey/questions');
        $response->assertStatus(200);
        $this->assertCount($questions->count(), $response->json());
    }

    /**
     * Test for question controller action IndexAsGuest
     *
     * @covers \KUHdo\Survey\Controllers\QuestionController::index
     * @small
     */
    public function testIndexAsGuest()
    {
        $response = $this->get('/survey/questions');
        $response->assertStatus(403);
    }

    /**
     * Test for question controller action Show
     *
     * @covers \KUHdo\Survey\Controllers\QuestionController::show
     * @small
     */
    public function testShow()
    {
        $user = User::create();
        $question = $this->createQuestion();
        $response = $this->actingAs($user)->get('/survey/questions/' . $question->id);
        $response->assertStatus(200);
        $this->assertEquals($question->id, $response->json()['id']);
    }

    /**
     * Test for question controller action ShowAsGuest
     *
     * @covers \KUHdo\Survey\Controllers\QuestionController::show
     * @small
     */
    public function testShowAsGuest()
    {
        $question = $this->createQuestion();
        $response = $this->get('/survey/questions/' . $question->id);
        $response->assertStatus(403);
    }

    /**
     * Test for question controller action Store
     *
     * @covers \KUHdo\Survey\Controllers\QuestionController::store
     * @small
     */
    public function testStore()
    {
        $survey = $this->createSurvey();
        $user = User::create();
        $data = array_merge($this->makeQuestion()->toArray(), ['survey_id' => $survey->id]);
        $response = $this->actingAs($user)->post('/survey/questions/', $data);
        $response->assertStatus(200);
        $this->assertTrue(Question::all()->count() > 0);
    }

    /**
     * Test for question controller action StoreAsGuest
     *
     * @covers \KUHdo\Survey\Controllers\QuestionController::store
     * @small
     */
    public function testStoreAsGuest()
    {
        $survey = $this->createSurvey();
        $data = array_merge($this->makeQuestion()->toArray(), ['survey_id' => $survey->id]);
        $response = $this->post('/survey/questions/', $data);
        $response->assertStatus(403);
    }

    /**
     * Test for question controller action StoreWithInvalidData
     *
     * @covers \KUHdo\Survey\Controllers\QuestionController::store
     * @small
     */
    public function testStoreWithInvalidData()
    {
        $this->createSurvey();
        $user = User::create();
        $response = $this->actingAs($user)->followingRedirects()->post('/survey/questions/', []);
        $response->assertStatus(404);
    }

    /**
     * Test for question controller action Update
     *
     * @covers \KUHdo\Survey\Controllers\QuestionController::update
     * @small
     */
    public function testUpdate()
    {
        $user = User::create();
        $updated = $this->makeQuestion(['question' => 'TestQuestion', 'category' => 'CategoryTest'])->toArray();
        $question = $this->createQuestion();
        $response = $this->actingAs($user)->put('/survey/questions/' . $question->id, $updated);
        $response->assertStatus(200);
        $this->assertEquals('TestQuestion', $response->json()['question']);
    }

    /**
     * Test for question controller action UpdateAsGuest
     *
     * @covers \KUHdo\Survey\Controllers\QuestionController::update
     * @small
     */
    public function testUpdateAsGuest()
    {
        $updated = $this->makeQuestion(['question' => 'TestQuestion', 'category' => 'CategoryTest'])->toArray();
        $question = $this->createQuestion();
        $response = $this->put('/survey/questions/' . $question->id, $updated);
        $response->assertStatus(403);
    }

    /**
     * Test for question controller action UpdateWithInvalidData
     *
     * @covers \KUHdo\Survey\Controllers\QuestionController::update
     * @small
     */
    public function testUpdateWithInvalidData()
    {
        $user = User::create();
        $question = $this->createQuestion();
        $response = $this->actingAs($user)->followingRedirects()->put('/survey/questions/' . $question->id, []);
        $response->assertStatus(404);
    }

    /**
     * Test for question controller action Delete
     *
     * @covers \KUHdo\Survey\Controllers\QuestionController::destroy
     * @small
     */
    public function testDelete()
    {
        $user = User::create();
        $question = $this->createQuestion();
        $response = $this->actingAs($user)->delete('/survey/questions/' . $question->id);
        $response->assertStatus(200);
        $this->assertFalse($question->exists());
    }

    /**
     * Test for question controller action DeleteAsGuest
     *
     * @covers \KUHdo\Survey\Controllers\QuestionController::destroy
     * @small
     */
    public function testDeleteAsGuest()
    {
        $question = $this->createQuestion();
        $response = $this->delete('/survey/questions/' . $question->id);
        $response->assertStatus(403);
        $this->assertTrue($question->exists());
    }
}
