<?php

return [
    'checkpoints' => [
        'live' => [],
        'ready' => [
                new Ferdous\K8s\CheckPoint\Cache(),
                new Ferdous\K8s\CheckPoint\Database()
        ],
        'startup' => [],
    ]
];
