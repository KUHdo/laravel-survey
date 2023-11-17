<?php

namespace KUHdo\Survey\Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use KUHdo\Survey\Models\Answer;
use KUHdo\Survey\Models\Question;
use KUHdo\Survey\Models\Survey;
use KUHdo\Survey\Tests\TestCase;
use KUHdo\Survey\Tests\User;

class AnswerControllerTest extends TestCase
{
    use WithoutMiddleware;

    /**
     * Test for answer controller action Index
     *
     * @covers \KUHdo\Survey\Controllers\AnswerController::Index
     *
     * @small
     */
    public function testIndex()
    {
        $user = User::create();
        $answers = Answer::factory()
            ->for($user, 'votable')
            ->for(Question::factory()->for(Survey::factory()))
            ->count(2)
            ->create();
        $response = $this->actingAs($user)
            ->get('/survey/answers');
        $response->assertStatus(200);
        $this->assertCount($answers->count(), $response->json());
    }

    /**
     * Test for answer controller action IndexAsGuest
     *
     * @covers \KUHdo\Survey\Controllers\AnswerController::index
     *
     * @small
     */
    public function testIndexAsGuest()
    {
        $response = $this->get('/survey/answers');
        $response->assertStatus(403);
    }

    /**
     * Test for answer controller action ShowAsOwner
     *
     * @covers \KUHdo\Survey\Controllers\AnswerController::show
     *
     * @small
     */
    public function testShowAsOwner()
    {
        $user = User::create();
        $answer = Answer::factory()
            ->for($user, 'votable')
            ->for(Question::factory()->for(Survey::factory()))
            ->create();
        $response = $this->actingAs($user)
            ->get('/survey/answers/'.$answer->id);
        $response->assertStatus(200);
        $this->assertEquals($answer->id, $response->json()['id']);
    }

    /**
     * Test for answer controller action ShowAsGuest
     *
     * @covers \KUHdo\Survey\Controllers\AnswerController::show
     *
     * @small
     */
    public function testShowAsGuest()
    {
        $answer = Answer::factory()
            ->for(Question::factory()->for(Survey::factory()))
            ->for(User::create(), 'votable')
            ->create();
        $response = $this->get('/survey/answers/'.$answer->id);
        $response->assertStatus(403);
    }

    /**
     * Test for answer controller action Store
     *
     * @covers \KUHdo\Survey\Controllers\AnswerController::store
     *
     * @small
     */
    public function testStore()
    {
        $question = Question::factory()
            ->for(Survey::factory())
            ->create();
        $user = User::create();
        $data = Answer::factory()->for($question)->raw();
        $response = $this->actingAs($user)
            ->post('/survey/answers/', $data);
        $response->assertStatus(200);

        $this->assertTrue($user->answers()->first()->exists());
    }

    /**
     * Test for answer controller action StoreAsGuest
     *
     * @covers \KUHdo\Survey\Controllers\AnswerController::store
     *
     * @small
     */
    public function testStoreAsGuest()
    {
        $data = Answer::factory()->raw(['question_id' => 1]);
        $response = $this->post('/survey/answers', $data);

        $response->assertStatus(403);
    }

    /**
     * Test for answer controller action StoreWithInvalidData
     *
     * @covers \KUHdo\Survey\Controllers\AnswerController::store
     *
     * @small
     */
    public function testStoreWithInvalidData()
    {
        $user = User::create();
        $response = $this->actingAs($user)
            ->followingRedirects()
            ->post('/survey/answers', []);
        $response->assertStatus(404);
    }

    /**
     * Test for answer controller action Update
     *
     * @covers \KUHdo\Survey\Controllers\AnswerController::update
     *
     * @small
     */
    public function testUpdate()
    {
        $user = User::create();
        $answer = Answer::factory()
            ->for($user, 'votable')
            ->for(Question::factory()->for(Survey::factory()))
            ->create();
        $updated = Answer::factory()->raw([
            'value' => '120',
            'type' => 'string',
        ]);
        $response = $this->actingAs($user)
            ->put('/survey/answers/'.$answer->id, $updated);
        $response->assertStatus(200);
        $this->assertEquals('120', $response->json()['value']);
    }

    /**
     * Test for answer controller action UpdateAsNotOwner
     *
     * @covers \KUHdo\Survey\Controllers\AnswerController::update
     *
     * @small
     */
    public function testUpdateAsNotOwner()
    {
        $user = User::create();
        $answer = Answer::factory()
            ->for(Question::factory()->for(Survey::factory()))
            ->for(User::create(), 'votable')
            ->create();
        $updated = Answer::factory()->raw([
            'value' => '120',
            'type' => 'string',
        ]);
        $response = $this->actingAs($user)
            ->put('/survey/answers/'.$answer->id, $updated);
        $response->assertStatus(403);
    }

    /**
     * Test for answer controller action UpdateAsGuest
     *
     * @covers \KUHdo\Survey\Controllers\AnswerController::update
     *
     * @small
     */
    public function testUpdateAsGuest()
    {
        $answer = Answer::factory()
            ->for(Question::factory()->for(Survey::factory()))
            ->for(User::create(), 'votable')
            ->create();
        $updated = Answer::factory()->raw([
            'value' => '120',
            'type' => 'string',
        ]);
        $response = $this->put('/survey/answers/'.$answer->id, $updated);
        $response->assertStatus(403);
    }

    /**
     * Test for answer controller action UpdateWithInvalidData
     *
     * @covers \KUHdo\Survey\Controllers\AnswerController::update
     *
     * @small
     */
    public function testUpdateWithInvalidData()
    {
        $user = User::create();
        $answer = Answer::factory()
            ->for($user, 'votable')
            ->for(Question::factory()->for(Survey::factory()))
            ->create();
        $response = $this->actingAs($user)
            ->followingRedirects()
            ->put('/survey/answers/'.$answer->id, []);
        $response->assertStatus(404);
    }

    /**
     * Test for answer controller action Delete
     *
     * @covers \KUHdo\Survey\Controllers\AnswerController::destroy
     *
     * @small
     */
    public function testDelete()
    {
        $user = User::create();
        $answer = Answer::factory()
            ->for($user, 'votable')
            ->for(Question::factory()->for(Survey::factory()))
            ->create();
        $response = $this->actingAs($user)
            ->delete('/survey/answers/'.$answer->id);
        $response->assertStatus(200);
        $this->assertFalse($answer->exists());
    }

    /**
     * Test for answer controller action DeleteAsNotOwner
     *
     * @covers \KUHdo\Survey\Controllers\AnswerController::destroy
     *
     * @small
     */
    public function testDeleteAsNotOwner()
    {
        $user = User::create();
        $answer = Answer::factory()
            ->for(Question::factory()->for(Survey::factory()))
            ->for(User::create(), 'votable')
            ->create();
        $response = $this->actingAs($user)
            ->delete('/survey/answers/'.$answer->id);
        $response->assertStatus(403);
        $this->assertTrue($answer->exists());
    }

    /**
     * Test for answer controller action DeleteAsGuest
     *
     * @covers \KUHdo\Survey\Controllers\AnswerController::destroy
     *
     * @small
     */
    public function testDeleteAsGuest()
    {
        $answer = Answer::factory()
            ->for(Question::factory()->for(Survey::factory()))
            ->create(['model_type' => 'test', 'model_id' => 1]);
        $response = $this->delete('/survey/answers/'.$answer->id);
        $response->assertStatus(403);
        $this->assertTrue($answer->exists());
    }
}
