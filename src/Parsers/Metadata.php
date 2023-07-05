<?php

namespace Antheta\Falcon\Parsers;

use Antheta\Falcon\Parsers\Interfaces\ParserInterface;

class Metadata implements ParserInterface
{
    public function parse(array $input): array 
    {
        if (!$input) {
            return [];
        }

        $parsedItems = [];
        foreach ($input as $node) {
            $parsedItems['title'] = ($node->find('title') !== null) ?? $node->find('title')->text();
            $parsedItems['description'] = ($node->find('meta[name="description"]') !== null) ?? $node->find('meta[name="description"]')->attr('content');
        }

        return $parsedItems;
    }
}