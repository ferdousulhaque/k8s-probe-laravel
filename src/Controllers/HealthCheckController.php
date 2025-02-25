<?php

namespace Ferdous\K8s\Controller;

use Ferdous\K8s\Probes\LivenessProbe;
use Ferdous\K8s\Probes\ReadinessProbe;
use Ferdous\K8s\Probes\StartupProbe;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

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
