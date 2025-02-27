<?php
namespace Ferdous\K8s\CheckPoint;

use Illuminate\Support\Facades\DB;
class DatabaseCheck implements CheckPointInterface
{
    private string $exception;
    /**
     * @return bool
     */
    function pass(): bool
    {
        try {
            // Check if the database connection can be established
            DB::connection()->getPdo();

            // Run a simple query to ensure queries are working
            $result = DB::select("SELECT 1 as test");

            if(!empty($result) && $result[0]->test == 1){
                return true;
            }
            $this->set_exception("Database Query Failed");
            return false;
        } catch (\Exception $e) {
            $this->set_exception("Database Connection Failed");
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
