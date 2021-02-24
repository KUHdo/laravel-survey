<?php


namespace KUHdo\Survey\Tests\Unit\Repositories\Question;

use Illuminate\Database\Eloquent\Collection;
use KUHdo\Survey\Repositories\Question\QuestionRepository;
use KUHdo\Survey\Tests\TestCase;
use KUHdo\Survey\Tests\User;

class RepositoryTest extends TestCase
{
    /**
     * @var QuestionRepository|null
     */
    private ?QuestionRepository $questionRepo;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->questionRepo = resolve(QuestionRepository::class);
    }

    /**
     * Should return Collection of Question.
     *
     * @covers \KUHdo\Survey\Repositories\Question\EloquentQuestionRepository
     * @medium
     */
    public function testReturnQuestionCollection()
    {
        $this->createQuestions(3);
        $this->assertInstanceOf(Collection::class, $this->questionRepo->getAll());
        $this->assertEquals(3, $this->questionRepo->getAll()->count());
    }

    /**
     * Should return Question with certain id.
     *
     * @covers \KUHdo\Survey\Repositories\Question\EloquentQuestionRepository
     * @medium
     */
    public function testReturnQuestionById()
    {
        $question = $this->createQuestion();
        $this->assertTrue($question->is($this->questionRepo->getById($question->id)));
    }

    /**
     * Should return Question Collection of given survey.
     *
     * @covers \KUHdo\Survey\Repositories\Question\EloquentQuestionRepository
     * @medium
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
     * Should return certain question with related answers.
     *
     * @covers \KUHdo\Survey\Repositories\Question\EloquentQuestionRepository
     * @medium
     */
    public function testReturnQuestionWithAnswers()
    {
        $question = $this->createQuestion();
        $this->createAnswers(3, [ 'question_id' => $question->id ]);

        $this->assertEquals(3, $this->questionRepo->getByIdWithAnswers($question->id)->answers->count());
    }

    /**
     * Should return certain question with related answers of given voter.
     *
     * @covers \KUHdo\Survey\Repositories\Question\EloquentQuestionRepository
     * @medium
     */
    public function testReturnQuestionWithAnswersAndVoter()
    {
        $user = User::create();
        $question = $this->createQuestion();
        $this->createAnswersWithUser($user, 3, [ 'question_id' => $question->id ]);
        $this->createAnswers(3, [ 'question_id' => $question->id ]);

        $this->assertEquals(
            3,
            $this->questionRepo->getByIdWithAnswersOfVoter($question->id, $user)->answers->count()
        );
    }

    /**
     * Should return Question Collection of given survey with answers and given voter.
     *
     * @covers \KUHdo\Survey\Repositories\Question\EloquentQuestionRepository
     * @medium
     */
    public function testReturnQuestionsOfSurveyWithAnswersOfVoter()
    {
        $user = User::create();
        $survey = $this->createSurvey();
        $questions = $this->createQuestions(3, [ 'survey_id' => $survey->id ]);
        $questions->each(function ($question) use ($user) {
            $this->createAnswersWithUser($user, 2, [ 'question_id' => $question->id ]);
        });

        $this->assertEquals(
            3,
            $this->questionRepo->getAllOfSurveyWithAnswersOfVoter($survey, $user)->count()
        );

        $this->assertEquals(
            2,
            $this->questionRepo->getAllOfSurveyWithAnswersOfVoter($survey, $user)->first()->answers->count()
        );
    }
}
