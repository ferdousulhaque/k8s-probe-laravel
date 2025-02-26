<?php

namespace Ferdous\K8s\Probes\DTO;

class Response
{
    private bool $status;
    private array $checkpoints = [];
    private string $exception = "";

    /**
     * @return array
     */
    function data(): array {
        return [
            'status' => $this->status,
            'checkpoints' => $this->checkpoints,
            'exception' => $this->exception
        ];
    }

    function set_status(bool $status): void{
        $this->status = $status;
    }

    function set_checkpoints(string $checkpoint): void{
        $this->checkpoints = array_merge_recursive($this->checkpoints,$checkpoint);
    }

    function set_exception(array $message): void{
        $this->exception = $message;
    }


}
