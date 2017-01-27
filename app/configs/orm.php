<?php

return [
    'orm.proxies_dir' => ROOT_PATH . '/storage/cache/doctrine/proxies',
    'orm.em.options'  => [
        'mappings' => [
            [
                'type'                         => 'annotation',
                'namespace'                    => 'Simonetti\Models',
                'path'                         => ROOT_PATH . '/src/Models',
                'use_simple_annotation_reader' => false,
            ],
        ],
    ],
];