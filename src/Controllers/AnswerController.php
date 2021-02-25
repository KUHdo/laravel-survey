<?php

namespace KUHdo\Survey\Controllers;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use KUHdo\Survey\Handlers\Answer\DeleteAnswer;
use KUHdo\Survey\Handlers\Answer\IndexAnswer;
use KUHdo\Survey\Contracts\Answer;
use KUHdo\Survey\Handlers\Answer\ShowAnswer;
use KUHdo\Survey\Handlers\Answer\StoreAnswer;
use KUHdo\Survey\Handlers\Answer\UpdateAnswer;
use KUHdo\Survey\Requests\AnswerRequest;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function index(): JsonResponse
    {
        $this->authorize('viewAny', Answer::class);
        $handler = new IndexAnswer();
        $answers = $handler();

        return response()->json($answers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AnswerRequest $request
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(AnswerRequest $request): JsonResponse
    {
        $this->authorize('create', Answer::class);
        $handler = new StoreAnswer();
        $answer = $handler($request);

        return response()->json($answer);
    }

    /**
     * Display the specified resource.
     *
     * @param int $answer
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function show(int $answer): JsonResponse
    {
        $answer = resolve(Answer::class)->findOrFailById($answer);
        $this->authorize('view', $answer);
        $handler = new ShowAnswer();
        $answer = $handler($answer);

        return response()->json($answer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AnswerRequest $request
     * @param int $answer
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(AnswerRequest $request, int $answer): JsonResponse
    {
        $answer = resolve(Answer::class)->findOrFail($answer);
        $this->authorize('update', $answer);
        $handler = new UpdateAnswer();
        $answer = $handler($request, $answer);

        return response()->json($answer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $answer
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws Exception
     */
    public function destroy(int $answer): JsonResponse
    {
        $answer = resolve(Answer::class)->findOrFailById($answer);
        $this->authorize('delete', $answer);
        $handler = new DeleteAnswer();
        $answer = $handler($answer);

        return response()->json($answer);
    }
}
