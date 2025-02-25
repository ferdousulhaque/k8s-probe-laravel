<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'k8s-probe'], function () {
    Route::get('/liveness', [\Ferdous\K8s\Controller\HealthCheckController::class, 'readiness']);
    Route::get('/readiness', [Ferdous\K8s\Controller\HealthCheckController::class, 'liveness']);
    Route::get('/startup', [Ferdous\K8s\Controller\HealthCheckController::class, 'startup']);
});
