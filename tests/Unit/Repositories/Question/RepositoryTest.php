<?php


namespace KUHdo\Survey\Tests\Unit\Repositories\Question;

use Illuminate\Database\Eloquent\Collection;
use KUHdo\Survey\Models\Answer;
use KUHdo\Survey\Models\Question;
use KUHdo\Survey\Models\Survey;
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
        Question::factory()
            ->count(3)
            ->for(Survey::factory())
            ->create();
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
        $question = Question::factory()
            ->for(Survey::factory())
            ->create();
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
        $survey = Survey::factory()
            ->has(Question::factory()->count(3))
            ->create();

        // another question for another survey
        Question::factory()->for(Survey::factory())->create();

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
        $question = Question::factory()
            ->for(Survey::factory())
            ->create();
        Answer::factory()
            ->count(3)
            ->for($question)
            ->create(['model_type' => 'test', 'model_id' => 1]);

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
        $question = Question::factory()
            ->for(Survey::factory())
            ->create();

        Answer::factory()
            ->count(3)
            ->for($user, 'votable')
            ->for($question)
            ->create();

        // 3 answers of an other user
        $otherUser = User::create();
        Answer::factory()
            ->count(3)
            ->for($question)
            ->for($otherUser, 'votable')
            ->create();

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
        $survey = Survey::factory()
            ->has(Question::factory()
                ->count(3)
                ->has(Answer::factory()
                    ->count(2)
                    ->for($user, 'votable')))
            ->create();

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
