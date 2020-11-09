<?php


namespace Kuhdo\Survey\Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Kuhdo\Survey\Survey;
use Kuhdo\Survey\Tests\TestCase;
use Kuhdo\Survey\Tests\Traits\WithSurvey;
use Kuhdo\Survey\Tests\User;

class SurveyControllerTest extends TestCase
{
    use WithSurvey;
    use WithoutMiddleware;

    public function testIndex()
    {
        $user = User::create();

        $surveys = $this->createSurveys(2);

        $response = $this->actingAs($user)->get('/survey/surveys/');


        $response->assertStatus(200);

        $this->assertEquals($surveys->count(), count($response->json()));
    }

    public function testIndexAsGuest()
    {
        $response = $this->get('/survey/surveys');

        $response->assertStatus(403);
    }

    public function testShow()
    {
        $user = User::create();

        $survey = $this->createSurvey();

        $response = $this->actingAs($user)->get('/survey/surveys/' . $survey->id);

        $response->assertStatus(200);
        $this->assertEquals($survey->id, $response->json()['id']);
    }

    public function testShowAsGuest()
    {
        $survey = $this->createSurvey();

        $response = $this->get('/survey/surveys/' . $survey->id);

        $response->assertStatus(403);
    }

    public function testStore()
    {
        $user = User::create();

        $data = array_merge($this->makeSurvey()->toArray());

        $response = $this->actingAs($user)->post('/survey/surveys/', $data);

        $response->assertStatus(200);
        $this->assertTrue(Survey::all()->count() > 0);
    }

    public function testStoreAsGuest()
    {
        $data = array_merge($this->makeSurvey()->toArray());

        $response = $this->post('/survey/surveys/', $data);

        $response->assertStatus(403);
    }

    public function testStoreWithInvalidData()
    {
        $user = User::create();

        $response = $this->actingAs($user)->followingRedirects()->post('/survey/surveys/', []);

        $response->assertStatus(404);
    }

    public function testUpdate()
    {
        $user = User::create();

        $updated = $this->makeSurvey(['title' => 'TestSurvey'])->toArray();

        $survey = $this-> createSurvey();

        $response = $this->actingAs($user)->put('/survey/surveys/' . $survey->id, $updated);

        $response->assertStatus(200);
        $this->assertEquals('TestSurvey', $response->json()['title']);
    }

    public function testUpdateAsGuest()
    {
        $updated = $this->makeSurvey(['title' => 'TestSurvey'])->toArray();

        $survey = $this->createSurvey();

        $response = $this->put('/survey/surveys/' . $survey->id, $updated);

        $response->assertStatus(403);
    }

    public function testUpdateWithInvalidData()
    {
        $user = User::create();

        $survey = $this->createSurvey();

        $response = $this->actingAs($user)->followingRedirects()->put('/survey/surveys/' . $survey->id, []);

        $response->assertStatus(404);
    }

    public function testDelete()
    {
        $user = User::create();

        $survey = $this->createSurvey();

        $response = $this->actingAs($user)->delete('/survey/surveys/' . $survey->id);

        $response->assertStatus(200);
        $this->assertFalse($survey->exists());
    }

    public function testDeleteAsGuest()
    {
        $survey = $this->createSurvey();

        $response = $this->delete('/survey/surveys/' . $survey->id);

        $response->assertStatus(403);
        $this->assertTrue($survey->exists());
    }
}
