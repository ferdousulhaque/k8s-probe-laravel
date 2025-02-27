<?php
namespace Ferdous\K8s\CheckPoint;
interface CheckPointInterface
{
    function pass(): bool;
    function set_exception($exception): void;
    function get_exception(): string;
}
