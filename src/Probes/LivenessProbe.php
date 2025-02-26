<?php

namespace Ferdous\K8s\Probes;

use Ferdous\K8s\Probes\DTO\Response;
use Ferdous\K8s\Probes\Enum\StatusCode;
use Illuminate\Http\JsonResponse;
use \Illuminate\Support\Facades\Config;

class LivenessProbe implements Probe
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
