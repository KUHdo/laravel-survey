<?php

namespace Kuhdo\Survey\Tests\Traits;

use Illuminate\Support\Facades\DB;
use Kuhdo\Survey\Tests\TestCase;

/**
 * Class WithAnswerTest
 * @package Kuhdo\Survey\Tests\Traits
 */
class WithAnswerTest extends TestCase
{
    use WithAnswer;

    /**
     * Should make answer
     */
    public function testMakeAnswer()
    {
        $answer = $this->makeAnswer();

        $this->assertEquals('Test', $answer->value);
        $this->assertEquals('Test', $answer->type);
    }

    /**
     * Should create answer and save to db
     */
    public function testCreateAnswer()
    {
        $this->createAnswer();

        $answer = DB::table('answers')->where('id', '=', 1)->first();

        $this->assertEquals('Test', $answer->value);
        $this->assertEquals('Test', $answer->type);
    }

    /**
     * Should make collection of answers
     */
    public function testMakeAnswers()
    {
        $answers = $this->makeAnswers(2);

        $this->assertEquals(2, $answers->count());
    }

    /**
     * Should create collection of answers and save to db
     */
    public function testCreateAnswers()
    {
        $this->createAnswers(2);

        $this->assertGreaterThan(1, DB::table('answers')->count());
    }
}
