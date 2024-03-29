<?php

namespace Antheta\Falcon\Parsers;

use Antheta\Falcon\Parsers\Interfaces\ParserInterface;

class Stylesheet implements ParserInterface
{
    public function parse(array $input): array 
    {
        if (!$input) {
            return [];
        }

        $stylesheets = array();
        foreach ($input as $node) {
            if ($node->find('link[rel="stylesheet"]')) {
                foreach ($node->find('link[rel="stylesheet"]') as $i => $node) {
                    if (
                        $node->attr("href") &&
                        !in_array(str_replace('&amp;', '&', $node->attr("href")), $stylesheets)
                    ) $stylesheets[] = str_replace('&amp;', '&', $node->attr("href"));
                }
            }
        }

        return $stylesheets;
    }
}