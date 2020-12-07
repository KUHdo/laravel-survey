<?php

namespace KUHdo\Survey\Tests\Traits;

use Illuminate\Support\Facades\DB;
use KUHdo\Survey\Tests\TestCase;

/**
 * Class WithQuestionTest
 * @package KUHdo\Survey\Tests\Traits
 */
class WithQuestionTest extends TestCase
{
    use WithQuestion;

    /**
     * Should make question
     */
    public function testMakeQuestion()
    {
        $question = $this->makeQuestion();

        $this->assertEquals('Test', $question->question);
        $this->assertEquals('Test', $question->category);
    }

    /**
     * Should create question and save to db
     */
    public function testCreateQuestion()
    {
        $this->createQuestion();

        $question = DB::table('questions')->where('id', '=', 1)->first();

        $this->assertEquals('Test', $question->question);
        $this->assertEquals('Test', $question->category);
    }

    /**
     * Should make collection of questions
     */
    public function testMakeQuestions()
    {
        $questions = $this->makeQuestions(2);

        $this->assertEquals(2, $questions->count());
    }

    /**
     * Should create collection of questions and save to db
     */
    public function testCreateQuestions()
    {
        $this->createQuestions(2);

        $this->assertGreaterThan(1, DB::table('questions')->count());
    }
}
