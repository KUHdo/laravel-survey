<?php

return [
    'cache' => [

        /**
         * By default all permissions are cached for 24 hours to speed up performance.
         */
        'expiration_time' => \DateInterval::createFromDateString('3 months'),

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
        'answer' => \KUHdo\Survey\Models\Answer::class,
        'question' => \KUHdo\Survey\Models\Question::class,
        'survey' => \KUHdo\Survey\Models\Survey::class,
    ],
];
