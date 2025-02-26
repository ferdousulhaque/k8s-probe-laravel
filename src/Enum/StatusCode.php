<?php
namespace Ferdous\K8s\Enum;

enum StatusCode : int
{
    case HTTP_OK = 200;
    case HTTP_LIVE_ERROR = 503;
    case HTTP_READY_ERROR = 500;
    case HTTP_START_ERROR = 410;
}
