<?php

if (is_file(__DIR__ . '/../vendor/autoload.php')) {
    require_once __DIR__ . '/../vendor/autoload.php';
} else {
    require_once __DIR__ . '/../../../autoload.php';
}

$appKey     = getenv('APP_KEY');
$userKey    = getenv('USER_KEY');
$userDevice = getenv('USER_DEVICE') ?: null;
