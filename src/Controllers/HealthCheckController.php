<?php

namespace Ferdous\K8s\Controller;

use CubeSystems\HealthCheck\Model\Heartbeat;
use Ferdous\K8s\Probes\LivenessProbe;
use Ferdous\K8s\Probes\ReadinessProbe;
use Ferdous\K8s\Probes\StartupProbe;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class HealthCheckController extends BaseController
{
    /**
     * Check if the server is ready to receive traffic
     *
     * @return JsonResponse
     */
    public function readiness(): JsonResponse
    {
        return ReadinessProbe::healthy();
    }

    /**
     * Check if the backend service is running without problems
     *
     * @return JsonResponse
     */
    public function liveness(): JsonResponse
    {
        return LivenessProbe::healthy();
    }

    /**
     * Check if the backend service is running without problems
     *
     * @return JsonResponse
     */
    public function startup(): JsonResponse
    {
        return StartupProbe::healthy();
    }
}
