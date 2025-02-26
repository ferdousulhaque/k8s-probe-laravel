<?php
namespace Ferdous\K8s\Checkpoint;
interface CheckPointInterface
{
    function status(): bool;
    function set_exception($exception): void;
    function get_exception(): string;
}
