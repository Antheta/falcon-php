<?php

namespace Antheta\Falcon\Parsers;

use Antheta\Falcon\Config\Email as EmailConfig;
use Antheta\Falcon\Parsers\Interfaces\ParserInterface;
use Antheta\Falcon\Validator;

class Email extends EmailConfig implements ParserInterface
{
    public function parse($input): array 
    {
        $content = $input["content"];

        $emails = [];
        foreach ($this->regex() as $regex) {
            foreach ($content as $node) {
                preg_match_all($regex, $node, $matches);
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