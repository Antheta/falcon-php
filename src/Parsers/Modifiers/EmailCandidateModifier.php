<?php

namespace Antheta\Falcon\Parsers\Modifiers;

class EmailCandidateModifier 
{
    public function handle(object $parser, string $candidate): string
    {
        return str_replace($parser->at_signs(), "@", $candidate);
    }
}