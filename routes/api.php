<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => config('k8s-health.route-prefix')], function () {
    Route::get('/liveness', [Ferdous\K8s\Controller\HealthCheckController::class, 'liveness']);
    Route::get('/readiness', [Ferdous\K8s\Controller\HealthCheckController::class, 'readiness']);
    Route::get('/readiness/{type}', [Ferdous\K8s\Controller\HealthCheckController::class, 'readinessByType']);
    Route::get('/startup', [Ferdous\K8s\Controller\HealthCheckController::class, 'startup']);
});
