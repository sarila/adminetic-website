<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Setting
    |--------------------------------------------------------------------------
    |
    */
    'google_analytics_dashboard_active' => false,
    'model_count_dashboard_active' => true,
    'post_dashboard_active' => false,
    'publish_migrations' => true,
    'migration_publish_path' => 'database/migrations/website',

    /*
    |--------------------------------------------------------------------------
    | Post Type
    |--------------------------------------------------------------------------
    |
    */
    'post_type' => [
        [
            'id' => 1,
            'name' => 'General Post',
        ],
        [
            'id' => 2,
            'name' => 'Video Post',
        ],
        [
            'id' => 3,
            'name' => 'Audio Post',
        ],
    ],
    /*
    |--------------------------------------------------------------------------
    | Block Group Theme
    |--------------------------------------------------------------------------
    |
    */
    'block_group_themes' => [1],
];
