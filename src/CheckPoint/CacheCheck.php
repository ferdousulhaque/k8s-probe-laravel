<?php
namespace Ferdous\K8s\CheckPoint;

use Illuminate\Support\Facades\Cache;
class CacheCheck implements CheckPointInterface
{
    private string $exception;

    const STORE_KEY = 'cache_check';
    const STORE_VALUE = 'dummy';
    const TTL = 10;
    /**
     * @return bool
     */
    function pass(): bool
    {
        try{
            Cache::put(self::STORE_KEY,self::STORE_VALUE,self::TTL);
            if(Cache::get(self::STORE_KEY) === self::STORE_VALUE){
                return true;
            }
            $this->set_exception("Cache Connection Failed");
            return false;
        }catch(\Exception $e){
            $this->set_exception("Cache Write Failed");
            return false;
        }
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
