<?php

namespace Antheta\Falcon\Parsers;

use Antheta\Falcon\Parsers\Interfaces\ParserInterface;

class Metadata implements ParserInterface
{
    public function parse($input): array 
    {
        $content = $input["doc"];

        $parsedItems = [];
        foreach ($content as $node) {
            $parsedItems['title'] = ($node->find('title') !== null) ?? $node->find('title')->text();
            $parsedItems['description'] = ($node->find('meta[name="description"]') !== null) ?? $node->find('meta[name="description"]')->attr('content');
        }

        return $parsedItems;
    }
}