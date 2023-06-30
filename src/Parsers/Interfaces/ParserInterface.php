<?php

namespace Antheta\Falcon\Parsers\Interfaces;

interface ParserInterface {
    /**
     * This method is for parsing the dom
     */
    public function parse($input): array;
}