# Lavavel Health Check Probes For Kubernetes
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
  GET|HEAD   k8s-probe/liveness ............................................................................................................. Ferdous\K8s › HealthCheckController@liveness
  GET|HEAD   k8s-probe/readiness ........................................................................................................... Ferdous\K8s › HealthCheckController@readiness
  GET|HEAD   k8s-probe/readiness/{type} .............................................................................................. Ferdous\K8s › HealthCheckController@readinessByType
  GET|HEAD   k8s-probe/startup ............................................................................................................... Ferdous\K8s › HealthCheckController@startup
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

## Contributors:
- A S Md Ferdousul Haque
- Mohammad Moniruzzaman Shovon

## License
MIT
