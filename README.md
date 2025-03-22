# Lavavel Health Check Probes For Kubernetes

[//]: # (![Packagist Downloads]&#40;https://img.shields.io/packagist/dt/ferdous/laravel-otp-validate&#41;)
[![License: MIT](https://img.shields.io/badge/License-MIT-green.svg)](https://opensource.org/licenses/MIT)

[//]: # (![Packagist Version]&#40;https://img.shields.io/packagist/v/ferdous/laravel-otp-validate&#41;)

[//]: # (![Packagist PHP Version Support]&#40;https://img.shields.io/packagist/php-v/ferdous/k8s-probe-laravel&#41;)
![GitHub code size in bytes](https://img.shields.io/github/languages/code-size/ferdousulhaque/k8s-probe-laravel)

For Kubernetes proper setup, it is recommended to expose the following endpoints.

K8s Reference Doc: [Configure Liveness, Readiness and Startup Probes](https://kubernetes.io/docs/tasks/configure-pod-container/configure-liveness-readiness-startup-probes/)

## Installing the package
You need to run the following command to install

```bash
composer require ferdous\k8s-probe-laravel
```

Publish the config and api files

```bash
php artisan vendor:publish
```
Select the package and press enter key. It will expose the routes and add config file `k8s-health.php`.

## Routes
The following routes are exposed for Kubernetes to check the health of the application.

- `k8s-probe/liveness`: For checking the application is live or not.
- `k8s-probe/readiness`: For checking if the required resources of application is accessible and working or not.
- `k8s-probe/startup`: For checking if the application is listening to port.
- `k8s-probe/readiness/{type}`: For checking if the application specific resource is working or not. You can add your custom checkpoints here

Once you run the `php artisan route:list`, check if the following routes are found

```text
  GET|HEAD   k8s-probe/liveness .................. Ferdous\K8s › HealthCheckController@liveness
  GET|HEAD   k8s-probe/readiness ................ Ferdous\K8s › HealthCheckController@readiness
  GET|HEAD   k8s-probe/readiness/{type} ... Ferdous\K8s › HealthCheckController@readinessByType
  GET|HEAD   k8s-probe/startup .................... Ferdous\K8s › HealthCheckController@startup
```

## Adding Custom Checkpoints
The package is dynamically built-in support for custom checkpoints. You can see the config `k8s-health.php` file.

`Any class here must implement CheckPointInterface`

```php

return [
    'checkpoints' => [
        'live' => [
            Custom\Checkpoint2:class
        ],
        'ready' => [
            Ferdous\K8s\CheckPoint\CacheCheck::class,
            Ferdous\K8s\CheckPoint\DatabaseCheck::class
        ],
        'startup' => [],
    ],
    'route-for-types' => [
        'cache' => Ferdous\K8s\CheckPoint\CacheCheck::class,
        'database' => Ferdous\K8s\CheckPoint\DatabaseCheck::class
    ],
];
```

Now implement the CheckPointInterface for the Checkpoint2

```php
namespace Custom;

class Checkpoint2 implements CheckPointInterface
{
    // Add your own logic for service running checks
    function pass(): bool;
    
    // Add your service specific exception message
    function set_exception($exception): void;
    
    // This is only for Checkers to get
    // the Checkpoint Specific exception message
    function get_exception(): string;
}
```
Now your Custom checkpoint is added for kubernetes health check automatically.

## Adding Type Checkpoint Routes
This package also includes support for adding different types for readiness of application by `type`.

```php

return [
    'route-for-types' => [
        'cache' => Ferdous\K8s\CheckPoint\CacheCheck::class,
        'database' => Ferdous\K8s\CheckPoint\DatabaseCheck::class
    ],
];
```

It exposes routes like `/k8s-probe/readiness/cache` and `/k8s-probe/readiness/database`.

You can make your own types like `/k8s-probe/readiness/custom-check`, just add a new key `custom-check` in the `route-for-types` array and do `config:clear`. Then new route should automatically work.

## Response

### Liveness
```json
{
    "status": true,
    "checkpoints": [],
    "exception": ""
}
```

### Readiness
```json
{
    "status": true,
    "checkpoints": [
        "Ferdous\\K8s\\CheckPoint\\CacheCheck",
        "Ferdous\\K8s\\CheckPoint\\DatabaseCheck"
    ],
    "exception": ""
}
```

### Startup
```json
{
    "status": true,
    "checkpoints": [],
    "exception": ""
}
```

### Readiness Type
```json
{
    "status": true,
    "checkpoints": [
      "Ferdous\\K8s\\CheckPoint\\DatabaseCheck"
    ],
    "exception": ""
}
```

## Contributors:
- A S Md Ferdousul Haque
- Mohammad Moniruzzaman Shovon

## License
MIT
