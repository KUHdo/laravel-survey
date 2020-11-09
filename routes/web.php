<?php

Route::resource('surveys', 'SurveyController')->except([
    'create', 'edit'
]);

Route::resource('questions', 'QuestionController')->except([
    'create', 'edit'
]);

Route::resource('answers', 'AnswerController')->except([
    'create', 'edit'
]);
