<?php

return [
    'checkpoints' => [
        'live' => [],
        'ready' => [
                new Ferdous\K8s\CheckPoint\CacheCheck(),
                new Ferdous\K8s\CheckPoint\DatabaseCheck()
        ],
        'startup' => [],
    ],
    'route-for-types' => [
        'cache' => new Ferdous\K8s\CheckPoint\CacheCheck(),
        'database' => new Ferdous\K8s\CheckPoint\DatabaseCheck()
    ],
];
