<?php

use KUHdo\Survey\Models\Answer;
use KUHdo\Survey\Models\Question;

return [
    'cache' => [

        /**
         * By default all permissions are cached for 24 hours to speed up performance.
         */
        'expiration_time' => DateInterval::createFromDateString('3 months'),

        /**
         * The cache key used to store all permissions.
         */
        'key' => 'kuhdo.survey.cache',

        /**
         * The cache store name to be used.
         */
        'store' => 'default',
    ],

    /**
     * Model bindings for resolution.
     */
    'models' => [
        'answer' => Answer::class,
        'question' => Question::class,
        'survey' => \KUHdo\Survey\Models\Survey::class,
    ],

    'routes' => [
        'namespace' => 'KUHdo\Survey\Controllers',
        'prefix' => 'survey',
        'middleware' => ['web'],
    ],
];
