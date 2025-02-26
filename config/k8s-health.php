<?php

return [
    'checkpoints' => [
        'live' => [],
        'ready' => [
                new Ferdous\K8s\Checkpoint\Cache(),
                new Ferdous\K8s\Checkpoint\Database()
        ],
        'startup' => [],
    ]
];
