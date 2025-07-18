<?php

return [

    'request' => [

        /*
         * Enable or disable request logger
         */

        'enabled' => true,

        /*
         * Array of handlers used for request logger
         */

        'handlers' => [
            TomatoPHP\FilamentLogger\Handlers\RequestLoggerHandler::class
        ],

        /*
         * Log to file
         */

        'log_file' => true,

        /*
         * Log to database
         */

        'database' => true,

        /*
         * Filename used for advanced logger
         */

        'file' => storage_path('logs/request.log'),

        /*
         * Log level to log requests
         */

        'level' => 'info',

        /*
         * Format of the log message, allowed values are:
         *
         * full - 'HTTP/{http-version} {status} | {remote-addr} | {user} | {method} {url} {query} | {response-time} s | {user-agent} | {referer}',
         * combined - '{remote-addr} - {remote-user} [{date}] "{method} {url} HTTP/{http-version}" {status} {content-length} "{referer}" "{user-agent}"',
         * common - '{remote-addr} - {remote-user} [{date}] "{method} {url} HTTP/{http-version}" {status} {content-length}',
         * dev - '{method} {url} {status} {response-time} s - {content-length}',
         * short - '{remote-addr} {remote-user} {method} {url} HTTP/{http-version} {status} {content-length} - {response-time} s',
         * tiny - '{method} {url} {status} {content-length} - {response-time} s'
         */

        'format' => 'full',

        /*
         * Url paths excluded from request logger
         */

        'excluded-paths' => [

        ],

        /*
         * Queue used to process request logger
         */

        'queue' => null,

        /*
         * Benchmark name used for request log
         */

        'benchmark' => 'application',


        /*
         * Log selected Guards
         */

        'guards' => [
            'web',
            'auth:accounts'
        ],

        /*
         * Log livewire update events
         */

        'livewire' => true,
    ],
];
