<?php

namespace Antheta\Falcon;

use Antheta\Falcon\Config\IpAddress;
use Antheta\Falcon\Config\Phonenumber;
use Antheta\Falcon\Validator;

class Parser extends Validator
{
    public static function parse($document, $parser) 
    {
        $parserClass = ucfirst($parser);
        if (class_exists("\\Antheta\\Falcon\\Parsers\\$parserClass") && is_string($parserClass)) {
            $parserClass = "\\Antheta\\Falcon\\Parsers\\$parserClass";
            try {
                return (new $parserClass)->parse($document);
            } catch(\Exception $e) {
                // do nothing
            }
        }
    }
}
