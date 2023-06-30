<?php

namespace Antheta\Falcon\Traits;

trait RegexControl
{
    public function addRegexes(array $regexes, $parser): mixed
    {
        if (isset($regexes) && is_array($regexes) && !empty($regexes)) {
            foreach($regexes as $regex_parser => $value) {
                $this->addRegex($value, $regex_parser, $parser);
            } 
        }

        return $parser;
    }

    public function addRegex(string $regex, $regex_parser, $parser): void
    {
        if ($regex_parser == $parser) {
            $this->custom_regexes[] = $regex;
        }
    }
}
