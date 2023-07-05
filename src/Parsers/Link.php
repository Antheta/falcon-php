<?php

namespace Antheta\Falcon\Parsers;

use Antheta\Falcon\Parsers\Interfaces\ParserInterface;

class Link implements ParserInterface
{
    protected $unallowed_in_link = ["tel:", "mailto:"];

    public function parse(array $input): array 
    {
        if (!$input) {
            return [];
        }

        $parsedItems = [];
        foreach ($input as $node) {
            $items = $node->find('a');

            if ($items) {
                foreach ($items as $item) {
                    $isUnallowed = false;
                    foreach($this->unallowed_in_link as $unallowed) {
                        if (strpos($item->attr('href'), $unallowed) !== false) {
                            $isUnallowed = true;
                        }
                    }

                    if ($isUnallowed) {
                        continue;
                    }

                    $parsedItems[] = $item->attr('href');
                }
            }
        }

        return array_unique($parsedItems);
    }
}