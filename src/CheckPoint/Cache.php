<?php
namespace Ferdous\K8s\CheckPoint;
class Cache implements CheckPointInterface
{
    private string $exception;
    /**
     * @return bool
     */
    function pass(): bool
    {
        $this->set_exception("Cache Connection Failed");
        return false;
    }

    /**
     * @param $exception
     * @return void
     */
    function set_exception($exception): void
    {
        $this->exception = $exception;
    }

    /**
     * @return string
     */
    function get_exception(): string
    {
        return $this->exception;
    }
}
