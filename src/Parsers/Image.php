<?php

namespace Antheta\Falcon\Parsers;

use Antheta\Falcon\Parsers\Interfaces\ParserInterface;

class Image implements ParserInterface
{
    public function parse($input): array 
    {
        $content = $input["doc"];

        $images = [];
        foreach ($content as $node) {
            if ($node->find('img[src]')) {
                foreach ($node->find('img[src]') as $i => $image) {
                    if ($image->attr("src")) {
                        if (!in_array(str_replace('&amp;', '&', $image->attr("src")), $images)) {
                            $images[] = str_replace('&amp;', '&', $image->attr("src"));
                        }
                    }
                }
            }
        }

        return $images;
    }
}