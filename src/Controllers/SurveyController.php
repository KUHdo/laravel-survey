<?php

namespace KUHdo\Survey\Controllers;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use KUHdo\Survey\Handlers\Survey\DeleteSurvey;
use KUHdo\Survey\Handlers\Survey\IndexSurvey;
use KUHdo\Survey\Handlers\Survey\ShowSurvey;
use KUHdo\Survey\Handlers\Survey\StoreSurvey;
use KUHdo\Survey\Handlers\Survey\UpdateSurvey;
use KUHdo\Survey\Requests\SurveyRequest;
use KUHdo\Survey\Contracts\Survey;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function index(): JsonResponse
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
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(SurveyRequest $request): JsonResponse
    {
        $this->authorize('create', Survey::class);
        $handler = new StoreSurvey();
        $survey = $handler($request);

        return response()->json($survey);
    }

    /**
     * Display the specified resource.
     *
     * @param int $survey
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function show(int $survey): JsonResponse
    {
        $survey = resolve(Survey::class)->findOrFailById($survey);
        $this->authorize('view', $survey);
        $handler = new ShowSurvey();
        $survey = $handler($survey);

        return response()->json($survey);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SurveyRequest $request
     * @param int $survey
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(SurveyRequest $request, int $survey): JsonResponse
    {
        $survey = resolve(Survey::class)->findOrFailById($survey);
        $this->authorize('update', $survey);
        $handler = new UpdateSurvey();
        $survey = $handler($request, $survey);

        return response()->json($survey);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $survey
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws Exception
     */
    public function destroy(int $survey): JsonResponse
    {
        $survey = resolve(Survey::class)->findOrFailById($survey);
        $this->authorize('delete', $survey);
        $handler = new DeleteSurvey();
        $survey = $handler($survey);

        return response()->json($survey);
    }
}
