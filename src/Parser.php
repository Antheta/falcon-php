<?php

namespace Antheta\Falcon;

class Parser
{
    public static function parse(array $document, string $parser, array $regexes, array $options = []): array
    {
        $parserClass = ucfirst($parser);
        if (class_exists("\\Antheta\\Falcon\\Parsers\\$parserClass") && is_string($parserClass)) {
            $parserClass = "\\Antheta\\Falcon\\Parsers\\$parserClass";
            try {
                $instance = (new $parserClass);

                // reset default regexes
                if (
                    isset($options["reset_default_regexes"]) && 
                    method_exists($instance, "resetDefaultRegexes")
                ) {
                    if (is_array($options["reset_default_regexes"]) && in_array($parser, $options["reset_default_regexes"])) {
                        $instance->resetDefaultRegexes();
                    }
                }

                // custom regexes
                if (method_exists($instance, "addRegexes")) {
                    $instance->addRegexes($regexes, $parser);
                }

                return $instance->parse($document);
            } catch(\Exception $e) {
                // do nothing
            }
        }

        return [];
    }
}
