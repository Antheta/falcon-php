<?php

namespace Antheta\Falcon\Parsers;

use Antheta\Falcon\Config\EmailConfig;
use Antheta\Falcon\Parsers\Interfaces\ParserInterface;
use Antheta\Falcon\Traits\RegexControl;

class Email extends EmailConfig implements ParserInterface
{
    use RegexControl;

    public function parse(array $doc): array 
    {
        if (!$doc) {
            return [];
        }

        $emails = [];
        foreach ($this->regex() as $regex) {
            foreach ($doc as $node) {
                @preg_match_all($regex, $node->html(), $candidates);
                if (!isset($candidates[0])) {
                    continue;
                }

                foreach ($candidates[0] as $candidate) {
                    if ($this->modifiers && is_array($this->modifiers)) {
                        foreach ($this->modifiers as $modifier) {
                            $emails[] = (new $modifier)->handle($this, $candidate);
                        }
                    }
                }
            }
        }

        return array_unique($emails);
    }
}