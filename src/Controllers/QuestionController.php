<?php

namespace KUHdo\Survey\Controllers;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use KUHdo\Survey\Handlers\Question\UpdateQuestion;
use KUHdo\Survey\Handlers\Question\DeleteQuestion;
use KUHdo\Survey\Handlers\Question\IndexQuestion;
use KUHdo\Survey\Handlers\Question\ShowQuestion;
use KUHdo\Survey\Handlers\Question\StoreQuestion;
use KUHdo\Survey\Models\Question;
use KUHdo\Survey\Requests\QuestionRequest;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function index(): JsonResponse
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
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(QuestionRequest $request): JsonResponse
    {
        $this->authorize('create', Question::class);
        $handler = new StoreQuestion();
        $question = $handler($request);

        return response()->json($question);
    }

    /**
     * Display the specified resource.
     *
     * @param Question $question
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function show(Question $question): JsonResponse
    {
        $this->authorize('view', $question);
        $handler = new ShowQuestion();
        $question = $handler($question);

        return response()->json($question);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param QuestionRequest $request
     * @param Question $question
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(QuestionRequest $request, $question): JsonResponse
    {
        $this->authorize('update', $question);
        $handler = new UpdateQuestion();
        $question = $handler($request, $question);

        return response()->json($question);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Question $question
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(Question $question): JsonResponse
    {
        $this->authorize('delete', $question);

        $handler = new DeleteQuestion();
        $question = $handler($question);

        return response()->json($question);
    }
}
