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

        'store' => 'default',
    ],
];
