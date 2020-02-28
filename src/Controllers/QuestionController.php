<?php

namespace Kuhdo\Survey\Controllers;

use Kuhdo\Survey\Handlers\Question\UpdateQuestion;
use Kuhdo\Survey\Handlers\Question\DeleteQuestion;
use Kuhdo\Survey\Handlers\Question\IndexQuestion;
use Kuhdo\Survey\Handlers\Question\ShowQuestion;
use Kuhdo\Survey\Handlers\Question\StoreQuestion;
use Kuhdo\Survey\Question;
use Kuhdo\Survey\Requests\QuestionRequest;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('viewAny', Question::class);

        $handler = new IndexQuestion();
        $questions = $handler();

        return response()->json($questions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param QuestionRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(QuestionRequest $request)
    {
        $this->authorize('create', Question::class);

        $handler = new StoreQuestion();
        $question = $handler($request);

        return response()->json($question);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($id)
    {
        $question = Question::find($id);
        $this->authorize('view', $question);

        $handler = new ShowQuestion();
        $question = $handler($question);

        return response()->json($question);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param QuestionRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(QuestionRequest $request, $id)
    {
        $question = Question::find($id);
        $this->authorize('update', $question);

        $handler = new UpdateQuestion();
        $question = $handler($request, $question);

        return response()->json($question);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($id)
    {
        $question = Question::find($id);
        $this->authorize('delete', $question);

        $handler = new DeleteQuestion();
        $question = $handler($question);

        return response()->json($question);
    }
}
