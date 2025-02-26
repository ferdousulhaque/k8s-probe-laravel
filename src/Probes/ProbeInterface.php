<?php

namespace Ferdous\K8s\Probes;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Config;

interface ProbeInterface
{
    public static function healthy(Config|null $config): JsonResponse;
}
