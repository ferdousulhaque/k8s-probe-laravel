<?php

namespace Ferdous\K8s\Probes;

use Ferdous\K8s\DTO\Response;
use Ferdous\K8s\Enum\StatusCode;
use Illuminate\Http\JsonResponse;
use \Illuminate\Support\Facades\Config;

class StartupProbe implements ProbeInterface
{
    public static function healthy(Config|null $config = null): JsonResponse
    {
        $response = new Response();
        $response->set_status(true);
        return response()
            ->json($response->data())
            ->setStatusCode(StatusCode::HTTP_OK->value);
    }
}
