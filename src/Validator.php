<?php

namespace Antheta\Falcon;

class Validator
{
    public static function email(string $payload): bool
    {
        return (filter_var($payload, FILTER_VALIDATE_EMAIL)) ? true : false;
    }

    public static function ip(string $payload): bool
    {
        return (filter_var($payload, FILTER_VALIDATE_IP)) ? true : false;
    }
}
