<?php

namespace Antheta\Falcon;

class Validator
{
    public static function email($payload)
    {
        return (filter_var($payload, FILTER_VALIDATE_EMAIL)) ? true : false;
    }

    public static function ip($payload)
    {
        return (filter_var($payload, FILTER_VALIDATE_IP)) ? true : false;
    }
}
