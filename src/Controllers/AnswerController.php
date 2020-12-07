<?php

namespace KUHdo\Survey\Controllers;

use KUHdo\Survey\Handlers\Answer\DeleteAnswer;
use KUHdo\Survey\Handlers\Answer\DeleteQuestion;
use KUHdo\Survey\Handlers\Answer\IndexAnswer;
use KUHdo\Survey\Handlers\Answer\IndexQuestion;
use KUHdo\Survey\Answer;
use KUHdo\Survey\Handlers\Answer\ShowAnswer;
use KUHdo\Survey\Handlers\Answer\ShowQuestion;
use KUHdo\Survey\Handlers\Answer\StoreAnswer;
use KUHdo\Survey\Handlers\Answer\StoreQuestion;
use KUHdo\Survey\Handlers\Answer\UpdateAnswer;
use KUHdo\Survey\Handlers\Answer\UpdateQuestion;
use KUHdo\Survey\Requests\AnswerRequest;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
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
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(AnswerRequest $request)
    {
        $this->authorize('create', Answer::class);

        $handler = new StoreAnswer();
        $answer = $handler($request);

        return response()->json($answer);
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
        $answer = Answer::findOrFail($id);
        $this->authorize('view', $answer);

        $handler = new ShowAnswer();
        $answer = $handler($answer);

        return response()->json($answer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AnswerRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(AnswerRequest $request, $id)
    {
        $answer = Answer::findOrFail($id);
        $this->authorize('update', $answer);

        $handler = new UpdateAnswer();
        $answer = $handler($request, $answer);

        return response()->json($answer);
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
        $answer = Answer::findOrFail($id);
        $this->authorize('delete', $answer);

        $handler = new DeleteAnswer();
        $answer = $handler($answer);

        return response()->json($answer);
    }
}
