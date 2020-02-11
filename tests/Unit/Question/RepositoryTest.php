<?php


namespace Kuhdo\Survey\Tests\Unit\Question;


use Illuminate\Database\Eloquent\Collection;
use Kuhdo\Survey\Repositories\Question\QuestionRepository;
use Kuhdo\Survey\Tests\TestCase;
use Kuhdo\Survey\Tests\Traits\WithAnswer;
use Kuhdo\Survey\Tests\User;

class RepositoryTest extends TestCase
{
    use WithAnswer;

    /**
     * @var QuestionRepository
     */
    private $questionRepo;

    protected function setUp(): void
    {
        parent::setUp();

        $this->questionRepo = resolve(QuestionRepository::class);
    }

    /**
     * Should return Collection of Question
     */
    public function testReturnQuestionCollection()
    {
        $this->createQuestions(3);

        $this->assertInstanceOf(Collection::class, $this->questionRepo->getAll());
        $this->assertEquals(3, $this->questionRepo->getAll()->count());
    }

    /**
     * Should return Question with certain id
     */
    public function testReturnQuestionById()
    {
        $question = $this->createQuestion();

        $this->assertTrue($question->is($this->questionRepo->getById($question->id)));
    }

    /**
     * Should return Question Collection of given survey
     */
    public function testReturnQuestionsOfSurvey()
    {
        $survey = $this->createSurvey();

        $this->createQuestions(3, [ 'survey_id' => $survey->id ]);
        $this->createQuestion();

        $this->assertEquals(3, $this->questionRepo->getAllOfSurvey($survey)->count());
        $this->assertEquals(4, $this->questionRepo->getAll()->count());
    }

    /**
     * Should return certain question with related answers
     */
    public function testReturnQuestionWithAnswers()
    {
        $question = $this->createQuestion();
        $this->createAnswers(3, [ 'question_id' => $question->id ]);

        $this->assertEquals(3, $this->questionRepo->getByIdWithAnswers($question->id)->answers->count());
    }

    /**
     * Should return certain question with related answers of given voter
     */
    public function testReturnQuestionWithAnswersAndVoter()
    {
        $user = User::create();
        $question = $this->createQuestion();

        $this->createAnswersWithUser($user, 3, [ 'question_id' => $question->id ]);
        $this->createAnswers( 3, [ 'question_id' => $question->id ]);

        $this->assertEquals(3, $this->questionRepo->getByIdWithAnswersOfVoter($question->id, $user)->answers->count());
    }

    /**
     * Should return Question Collection of given survey
     */
    public function testReturnQuestionsOfSurveyWithAnswersOfVoter()
    {
        $user = User::create();
        $survey = $this->createSurvey();

        $questions = $this->createQuestions(3, [ 'survey_id' => $survey->id ]);

        $questions->each(function ($question) use ($user) {
            $this->createAnswersWithUser($user, 2, [ 'question_id' => $question->id ]);
        });

        $this->assertEquals(3, $this->questionRepo->getAllOfSurveyWithAnswersOfVoter($survey, $user)->count());
        $this->assertEquals(2, $this->questionRepo->getAllOfSurveyWithAnswersOfVoter($survey, $user)->first()->answers->count());
    }
}