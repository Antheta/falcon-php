<?php

namespace Antheta\Falcon\Parsers;

use Antheta\Falcon\Config\EmailConfig;
use Antheta\Falcon\Parsers\Interfaces\ParserInterface;
use Antheta\Falcon\Traits\RegexControl;
use Antheta\Falcon\Validator;

class Email extends EmailConfig implements ParserInterface
{
    use RegexControl;

    public function parse($doc): array 
    {
        if (!$doc) {
            return [];
        }

        $emails = [];
        foreach ($this->regex() as $regex) {
            foreach ($doc as $node) {
                @preg_match_all($regex, $node->html(), $matches);
                if (!isset($matches[0])) {
                    continue;
                }

                foreach ($matches[0] as $m) {
                    $r = str_replace($this->at_signs(), "@", $m);
                    if (Validator::email($r)) {
                        if (!in_array($m, $emails)) {
                            $emails[] = $m;
                        }
                    }
                }
            }
        }

        return $emails;
    }
}