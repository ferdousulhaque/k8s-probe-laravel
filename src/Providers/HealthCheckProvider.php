<?php
namespace Ferdous\K8s\Providers;

use Illuminate\Support\ServiceProvider;

class HealthCheckProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function register()
    {
        $this->app->make('Ferdous\K8s\Controller\HealthCheckController');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Config Copy
        $source = realpath(__DIR__ . '/../config/k8s-health.php');
        $this->mergeConfigFrom($source, 'k8s-health');

        // Route Copy
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
    }
}
