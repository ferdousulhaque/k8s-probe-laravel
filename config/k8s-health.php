<?php
// Any class here must implement CheckPointInterface
return [
    'route-prefix' => env('K8S_HEALTH_CHECK_ROUTE_PREFIX', 'k8s-probe'),
    'checkpoints' => [
        'live' => [],
        'ready' => [
            Ferdous\K8s\CheckPoint\CacheCheck::class,
            Ferdous\K8s\CheckPoint\DatabaseCheck::class
        ],
        'startup' => [],
    ],
    'route-for-types' => [
        'cache' => Ferdous\K8s\CheckPoint\CacheCheck::class,
        'database' => Ferdous\K8s\CheckPoint\DatabaseCheck::class
    ],
];
