<?php

Route::apiResources([
    'surveys' => 'SurveyController',
    'questions' => 'QuestionController',
    'answers' => 'AnswerController'
]);
