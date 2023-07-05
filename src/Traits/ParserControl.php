<?php

namespace Antheta\Falcon\Traits;

use Antheta\Falcon\Config\App;

trait ParserControl
{
    protected array $parsers = App::PARSERS;
    protected array $custom_regexes = [];
    protected array $parser_options = [];

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

    public function addRegexes($parser, $regexes) 
    {
        if (isset($regexes) && is_array($regexes) && !empty($regexes)) {
            foreach ($regexes as $regex) {
                $this->addRegex($parser, $regex);
            }
        }
    }

    public function addRegex($parser, string $regex): void
    {
        $this->custom_regexes[$parser] = $regex;
    }

    public function resetDefaultRegexes($parser = null)
    {
        $this->parser_options["reset_default_regexes"] = ($parser) ? $parser : true;
    }
}
