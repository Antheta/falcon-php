<?php

namespace Antheta\Falcon\Parsers;

use Antheta\Falcon\Parsers\Interfaces\ParserInterface;

class Script implements ParserInterface
{
    public function parse(array $input): array 
    {
        if (!$input) {
            return [];
        }

        $parsedItems = [];
        foreach ($input as $node) {
            $items = $node->find('script[src]');

            if ($items) {
                foreach ($items as $item) {
                    $parsedItems[] = str_replace('&amp;', '&', $item->attr("src"));
                }
            }
        }
        
        return array_unique($parsedItems);
    }
}