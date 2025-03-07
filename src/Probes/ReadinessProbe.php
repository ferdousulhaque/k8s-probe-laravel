<?php

namespace Ferdous\K8s\Probes;

use Ferdous\K8s\CheckPoint\CheckPointInterface;
use Ferdous\K8s\DTO\Response;
use Ferdous\K8s\Enum\Messages;
use Ferdous\K8s\Enum\StatusCode;
use Illuminate\Http\JsonResponse;
use \Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;

class ReadinessProbe implements ProbeInterface
{
    public static function healthy(Config|null $config = null): JsonResponse
    {
        $response = new Response();
        $checkpoints = config('k8s-health.checkpoints.ready');
        if(!empty($checkpoints)){
            foreach($checkpoints as $checkpoint){
                //TODO: Need to reduce code duplication
                $checkpoint = new $checkpoint();
                if($checkpoint instanceof CheckPointInterface){
                    $status = $checkpoint->pass();
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
                }else{
                    $response->set_exception(Messages::NOT_AN_INSTANCE->value);
                    $response->set_status(false);
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

    public static function healthyByType(Request $request, string $type): JsonResponse
    {
        $response = new Response();
        $checkpoint_types = config('k8s-health.route-for-types');
        if(!isset($checkpoint_types[$type])){
            $response->set_exception(Messages::CHECKPOINT_NOT_EXIST->value);
            $response->set_status(false);
            return response()
                ->json($response->data())
                ->setStatusCode(StatusCode::HTTP_READY_ERROR->value);
        }else{
            $checkpoint = $checkpoint_types[$type];
            $checkpoint = new $checkpoint();
            if($checkpoint instanceof CheckPointInterface) {
                $status = $checkpoint->pass();
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
            }else{
                $response->set_exception(Messages::NOT_AN_INSTANCE->value);
                $response->set_status(false);
                return response()
                    ->json($response->data())
                    ->setStatusCode(StatusCode::HTTP_READY_ERROR->value);
            }
        }
        $response->set_status(true);
        return response()
            ->json($response->data())
            ->setStatusCode(StatusCode::HTTP_OK->value);
    }
}
