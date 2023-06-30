<?php

namespace Antheta\Falcon\Traits;

trait ParserControl
{
    /**
     * Add a custom parser
     * 
     * @param string $parser
     * @param mixed $fn
     * @return \Antheta\Falcon\Core
     */
    public function addParser($parser, $fn): \Antheta\Falcon\Core
    {
        $this->parsers[$parser] = $fn;

        return $this;
    }

    public function disableParsers($parsers): \Antheta\Falcon\Core
    {
        foreach ($this->parsers as $parser) {
            foreach ($parsers as $parser) {
                if (in_array($parser, $this->parsers)) {
                    unset($this->parsers[$parser]);
                }
            }
        }

        return $this;
    }
}
