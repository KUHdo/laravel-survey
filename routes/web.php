<?php

use KUHdo\Survey\Models\Controllers\AnswerController;
use KUHdo\Survey\Models\Controllers\QuestionController;
use KUHdo\Survey\Models\Controllers\SurveyController;

Route::resource('surveys', SurveyController::class)
    ->except([
        'create', 'edit'
    ]);

Route::resource('questions', QuestionController::class)
    ->except([
        'create', 'edit'
]);

Route::resource('answers', AnswerController::class)
    ->except([
        'create', 'edit'
]);
