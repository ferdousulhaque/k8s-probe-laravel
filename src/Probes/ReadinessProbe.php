<?php

namespace Ferdous\K8s\Probes;

use Ferdous\K8s\Probes\DTO\Response;
use Ferdous\K8s\Probes\Enum\StatusCode;
use Illuminate\Http\JsonResponse;
use \Illuminate\Support\Facades\Config;

class ReadinessProbe implements Probe
{
    public static function healthy(Config|null $config = null): JsonResponse
    {
        $response = new Response();
        $checkpoints = config('k8s-health.checkpoints.ready');
        if(!empty($checkpoints)){
            foreach($checkpoints as $checkpoint){
                $status = $checkpoint->status();
                $response->set_checkpoints(get_class($checkpoint));
                if(!$status){
                    $response->set_exception(
                        $checkpoint->get_exception()
                    );
                    $response->set_status($status);
                    return response()
                        ->json($response->data())
                        ->setStatusCode(StatusCode::HTTP_READY_ERROR->value);
                }
            }
        }
        $response->set_status(true);
        return response()
            ->json($response->data())
            ->setStatusCode(StatusCode::HTTP_OK->value);
    }
}
