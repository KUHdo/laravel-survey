<?php


namespace KUHdo\Survey\Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use KUHdo\Survey\Models\Survey;
use KUHdo\Survey\Tests\TestCase;
use KUHdo\Survey\Tests\User;

class SurveyControllerTest extends TestCase
{
    use WithoutMiddleware;

    /**
     * Basic feature test for controller action.
     *
     * @small
     * @covers \KUHdo\Survey\Models\Controllers\SurveyController::index
     */
    public function testIndex()
    {
        $user = User::create();
        $surveys = Survey::factory()->count(2)->create();
        $response = $this->actingAs($user)
            ->get('/survey/surveys/');
        $response->assertStatus(200);
        $this->assertCount($surveys->count(), $response->json());
    }

    /**
     * Basic feature test for controller action.
     *
     * @small
     * @covers \KUHdo\Survey\Models\Controllers\SurveyController::index
     */
    public function testIndexAsGuest()
    {
        $response = $this->get('/survey/surveys');
        $response->assertStatus(403);
    }

    /**
     * Basic feature test for controller action.
     *
     * @small
     * @covers \KUHdo\Survey\Models\Controllers\SurveyController::show
     */
    public function testShow()
    {
        $user = User::create();
        $survey = Survey::factory()->create();
        $response = $this->actingAs($user)
            ->get('/survey/surveys/' . $survey->id);
        $response->assertStatus(200);
        $this->assertEquals($survey->id, $response->json()['id']);
    }

    /**
     * Basic feature test for controller action.
     *
     * @small
     * @covers \KUHdo\Survey\Models\Controllers\SurveyController::show
     */
    public function testShowAsGuest()
    {
        $survey = Survey::factory()->create();
        $response = $this->get('/survey/surveys/' . $survey->id);
        $response->assertStatus(403);
    }

    /**
     * Basic feature test for controller action.
     *
     * @small
     * @covers \KUHdo\Survey\Models\Controllers\SurveyController::store
     */
    public function testStore()
    {
        $user = User::create();
        $data = Survey::factory()->raw();
        $response = $this->actingAs($user)
            ->post('/survey/surveys/', $data);
        $response->assertStatus(200);
        $this->assertGreaterThan(Survey::all()->count(), 0);
    }

    /**
     * Basic feature test for controller action.
     *
     * @small
     * @covers \KUHdo\Survey\Models\Controllers\SurveyController::store
     */
    public function testStoreAsGuest()
    {
        $data = Survey::factory()->raw();
        $response = $this->post('/survey/surveys/', $data);
        $response->assertStatus(403);
    }

    /**
     * Basic feature test for controller action.
     *
     * @small
     * @covers \KUHdo\Survey\Models\Controllers\SurveyController::store
     */
    public function testStoreWithInvalidData()
    {
        $user = User::create();
        $response = $this->actingAs($user)
            ->followingRedirects()
            ->post('/survey/surveys/', []);
        $response->assertStatus(404);
    }

    /**
     * Basic feature test for controller action.
     *
     * @small
     * @covers \KUHdo\Survey\Models\Controllers\SurveyController::store
     */
    public function testUpdate()
    {
        $user = User::create();
        $updated = Survey::factory()->state(['title' => 'TestSurvey'])->raw();
        $survey = Survey::factory()->create();
        $response = $this->actingAs($user)
            ->put('/survey/surveys/' . $survey->id, $updated);
        $response->assertStatus(200);
        $this->assertEquals('TestSurvey', $response->json()['title']);
    }

    /**
     * Basic feature test for controller action.
     *
     * @small
     * @covers \KUHdo\Survey\Models\Controllers\SurveyController::update
     */
    public function testUpdateAsGuest()
    {
        $updated = Survey::factory()
            ->state(['title' => 'TestSurvey'])
            ->raw();
        $survey = Survey::factory()->create();
        $response = $this->put('/survey/surveys/' . $survey->id, $updated);
        $response->assertStatus(403);
    }

    /**
     * Basic feature test for controller action.
     *
     * @small
     * @covers \KUHdo\Survey\Models\Controllers\SurveyController::update
     */
    public function testUpdateWithInvalidData()
    {
        $user = User::create();
        $survey = Survey::factory()->create();
        $response = $this->actingAs($user)
            ->followingRedirects()
            ->put('/survey/surveys/' . $survey->id, []);
        $response->assertStatus(404);
    }

    /**
     * Basic feature test for controller action.
     *
     * @small
     * @covers \KUHdo\Survey\Models\Controllers\SurveyController::destroy
     */
    public function testDelete()
    {
        $user = User::create();
        $survey = Survey::factory()->create();
        $response = $this->actingAs($user)
            ->delete('/survey/surveys/' . $survey->id);
        $response->assertStatus(200);
        $this->assertFalse($survey->exists());
    }

    /**
     * Basic feature test for controller action.
     *
     * @small
     * @covers \KUHdo\Survey\Models\Controllers\SurveyController::destroy
     */
    public function testDeleteAsGuest()
    {
        $survey = Survey::factory()->create();
        $response = $this->delete('/survey/surveys/' . $survey->id);
        $response->assertStatus(403);
        $this->assertTrue($survey->exists());
    }
}
