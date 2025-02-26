# Lavavel Health Check Probes For Kubernetes
For Kubernetes proper setup, it is recommended to expose the following endpoints.

K8s Reference Doc: [Configure Liveness, Readiness and Startup Probes](https://kubernetes.io/docs/tasks/configure-pod-container/configure-liveness-readiness-startup-probes/)

## Installing the package
You need to run the following command to install

```bash
composer require ferdous\k8s-probe-laravel
```

It will ask for publishing once installed. Please press `Y`

## Adding new Checkpoints
The package is dynamically built-in support for custom checkpoints. You can see the config `k8s-health.php` file.

```php
return [
    'checkpoints' => [
        'live' => [
            new Custom\Checkpoint2()
        ],
        'ready' => [
                new Ferdous\K8s\Checkpoint\Cache(),
                new Ferdous\K8s\Checkpoint\Database()
        ],
        'startup' => [],
    ]
];
```

Now implement the CheckPointInterface for the Checkpoint2

```php
class Checkpoint2 implements CheckPointInterface
{
    // Implement the functions
}
```
Now your Custom checkpoint is added for kubernetes health check automatically.

## Contributors:
- A S Md Ferdousul Haque
- Mohammad Moniruzzaman Shovon

## License
MIT
