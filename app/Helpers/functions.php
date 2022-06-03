<?php

function success(string $msg)
{
    return [
        'type' => 'success',
        'msg' => $msg
    ];
}

function error(string $msg)
{
    return [
        'type' => 'danger',
        'msg' => $msg
    ];
}

function warning(string $msg)
{
    return [
        'type' => 'warning',
        'msg' => $msg
    ];
}

function alert(string $msg)
{
    return [
        'type' => 'info',
        'msg' => $msg
    ];
}
