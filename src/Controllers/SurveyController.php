<?php

namespace Kuhdo\Survey\Controllers;

use Kuhdo\Survey\Handlers\Survey\DeleteSurvey;
use Kuhdo\Survey\Handlers\Survey\IndexSurvey;
use Kuhdo\Survey\Handlers\Survey\ShowSurvey;
use Kuhdo\Survey\Handlers\Survey\StoreSurvey;
use Kuhdo\Survey\Handlers\Survey\UpdateSurvey;
use Kuhdo\Survey\Requests\SurveyRequest;
use Kuhdo\Survey\Survey;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('viewAny', Survey::class);

        $handler = new IndexSurvey();
        $surveys = $handler();

        return response()->json($surveys);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SurveyRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(SurveyRequest $request)
    {
        $this->authorize('create', Survey::class);

        $handler = new StoreSurvey();
        $survey = $handler($request);

        return response()->json($survey);
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
        $survey = Survey::find($id);
        $this->authorize('view', $survey);

        $handler = new ShowSurvey();
        $survey = $handler($survey);

        return response()->json($survey);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SurveyRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(SurveyRequest $request, $id)
    {
        $survey = Survey::find($id);
        $this->authorize('update', $survey);

        $handler = new UpdateSurvey();
        $survey = $handler($request, $survey);

        return response()->json($survey);
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
        $survey = Survey::find($id);
        $this->authorize('delete', $survey);

        $handler = new DeleteSurvey();
        $survey = $handler($survey);

        return response()->json($survey);
    }
}
