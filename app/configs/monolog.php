<?php
return [
    'monolog.logfile' => ROOT_PATH . '/storage/logs/' . env('APP_ENV', 'dev') . '-' . date('y-m-d') . '.log',
];