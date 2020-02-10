<?php

namespace Kuhdo\Survey\Tests\Traits;

use Illuminate\Support\Facades\DB;
use Kuhdo\Survey\Tests\TestCase;

/**
 * Class WithSurveyTest
 * @package Kuhdo\Survey\Tests\Traits
 */
class WithSurveyTest extends TestCase
{
    use WithSurvey;

    /**
     * Should make a survey
     */
    public function testMakeSurvey()
    {
        $survey = $this->makeSurvey();

        $this->assertEquals('Test', $survey->title);
    }

    /**
     * Should create a survey and save to db
     */
    public function testCreateSurvey()
    {
        $this->createSurvey();

        $survey = DB::table('surveys')->where('id', '=', 1)->first();

        $this->assertEquals('Test', $survey->title);
    }

    /**
     * Should make a collection of surveys
     */
    public function testMakeSurveys()
    {
        $surveys = $this->makeSurveys(2);

        $this->assertEquals(2, $surveys->count());
    }

    /**
     * Should create a collection of surveys and save to db
     */
    public function testCreateSurveys()
    {
        $this->createSurveys(2);

        $this->assertGreaterThan(1, DB::table('surveys')->count());
    }
}
