<?php

namespace Kuhdo\Survey\Controllers;

use Kuhdo\Survey\Handlers\Answer\IndexAnswer;
use Kuhdo\Survey\Answer;
use Illuminate\Http\Request;
use Kuhdo\Survey\Handlers\Answer\ShowAnswer;
use Kuhdo\Survey\Requests\AnswerRequest;

class AnswerController extends Controller
{
    /**
     * AnswerController constructor.
     */
    public function __construct()
    {
        // $this->authorizeResource(Answer::class, 'answer');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $handler = new IndexAnswer();
        $answers = $handler();

        return response()->json($answers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AnswerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnswerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function show(Answer $answer)
    {
        $handler = new ShowAnswer();
        $answer = $handler($answer);

        response()->json($answer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AnswerRequest  $request
     * @param  Answer $answer
     * @return \Illuminate\Http\Response
     */
    public function update(AnswerRequest $request, Answer $answer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Answer $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answer $answer)
    {
        //
    }
}
