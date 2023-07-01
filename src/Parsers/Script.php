<?php

namespace Antheta\Falcon\Parsers;

use Antheta\Falcon\Parsers\Interfaces\ParserInterface;

class Script implements ParserInterface
{
    public function parse($input): array 
    {
        $content = $input["doc"];

        $parsedItems = [];
        foreach ($content as $node) {
            $items = $node->find('script[src]');

            if ($items) {
                foreach ($items as $script) {
                    $parsedItems[] = str_replace('&amp;', '&', $script->attr("src"));
                }
            }
        }
        
        return $parsedItems;
    }
}