<?php

namespace Antheta\Falcon\Parsers;

use Antheta\Falcon\Config\PhonenumberConfig;
use Antheta\Falcon\Parsers\Interfaces\ParserInterface;
use Antheta\Falcon\Traits\RegexControl;

class Phonenumber extends PhonenumberConfig implements ParserInterface
{
    use RegexControl;

    public function parse($input): array 
    {
        if (!$input) {
            return [];
        }

        $phonenumbers = [];
        foreach ($input as $node) {
            if (
                $node->find("a") &&
                $node->find("a")->attr("href") &&
                strpos($node->find("a")->attr("href"), 'tel:') !== false
            ) {
                $phonenumber = $node->find("a")->attr("href");
                foreach ($this->regex() as $regex) {
                    @preg_match_all($regex, $phonenumber, $matches);
                    if (!isset($matches[0])) {
                        continue;
                    }
                    
                    foreach ($matches[0] as $m) {
                        if (!in_array($m, $phonenumbers)) {
                            $phonenumbers[] = $m;
                        }
                    }
                }
            }
        }

        return $phonenumbers;
    }
}