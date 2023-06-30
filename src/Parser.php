<?php

namespace Antheta\Falcon;

use Antheta\Falcon\Validator;

class Parser extends Validator
{
    public static function parse($document, $parser, $regexes) 
    {
        $parserClass = ucfirst($parser);
        if (class_exists("\\Antheta\\Falcon\\Parsers\\$parserClass") && is_string($parserClass)) {
            $parserClass = "\\Antheta\\Falcon\\Parsers\\$parserClass";
            try {
                $instance = (new $parserClass);

                // custom regexes
                if (method_exists($instance, "addRegexes")) {
                    $instance->addRegexes($regexes, $parser);
                }

                return $instance->parse($document);
            } catch(\Exception $e) {
                // do nothing
            }
        }
    }
}
