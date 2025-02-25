<?php

namespace Ferdous\K8s\Probes;

use Ferdous\K8s\Probes\DTO\Response;
use Illuminate\Http\JsonResponse;
use \Illuminate\Support\Facades\Config;

class ReadinessProbe implements Probe
{
    const HTTP_OK = 200;

    public static function healthy(Config|null $config = null): JsonResponse
    {
        $response = new Response();
        $response->set_status(true);
        return response()
            ->json($response->data())
            ->setStatusCode(self::HTTP_OK);
    }
}
