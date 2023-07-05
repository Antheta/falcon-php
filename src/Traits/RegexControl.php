<?php

namespace Antheta\Falcon\Traits;

trait RegexControl
{
    public function addRegexes(array $regexes, string $parser): mixed
    {
        if (isset($regexes) && is_array($regexes) && !empty($regexes)) {
            foreach($regexes as $regex_parser => $value) {
                $this->addRegex($value, $regex_parser, $parser);
            } 
        }

        return $parser;
    }

    public function addRegex(string $regex, string $regex_parser, string $parser): void
    {
        if ($regex_parser == $parser) {
            $this->custom_regexes[] = $regex;
        }
    }

    public function resetDefaultRegexes(): void
    {
        if (isset($this->default_regexes)) {
            $this->default_regexes = [];
        }
    }
}
