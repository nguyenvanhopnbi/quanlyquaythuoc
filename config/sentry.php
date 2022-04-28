<?php

return [
    // sentry

    'dsn' => env('SENTRY_LARAVEL_DSN', env('SENTRY_DSN')),
    // 'dsn' => 'https://2dea2985760c4fa7806c3a139e666ae5:b803df97a49f4a5dbb93be971594f1b3@sentry.appotapay.com/48',

    // capture release as git sha
    // 'release' => trim(exec('git --git-dir ' . base_path('.git') . ' log --pretty="%h" -n1 HEAD')),

    'breadcrumbs' => [
        // Capture Laravel logs in breadcrumbs
        'logs' => true,

        // Capture SQL queries in breadcrumbs
        'sql_queries' => true,

        // Capture bindings on SQL queries logged in breadcrumbs
        'sql_bindings' => true,

        // Capture queue job information in breadcrumbs
        'queue_info' => true,

        // Capture command information in breadcrumbs
        'command_info' => true,
    ],

    // @see: https://docs.sentry.io/error-reporting/configuration/?platform=php#send-default-pii
    'send_default_pii' => false,

];
