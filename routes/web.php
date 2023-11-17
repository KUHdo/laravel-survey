<?php

use Illuminate\Support\Facades\Route;

Route::apiResources([
    'surveys' => 'SurveyController',
    'questions' => 'QuestionController',
    'answers' => 'AnswerController',
]);
