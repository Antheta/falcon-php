<?php

namespace Antheta\Falcon;

use Antheta\Falcon\Utils;
use Antheta\Falcon\Parser;
use Exception;

class Core extends Utils
{
    public $target; 

    public $result = [];

    public $custom_driver_result = [];

    public $document = [];

    /**
     * Run Scraper
     * 
     * @param string $target
     * @return Core
     */
    public function run($target = null) : Core
    {
        try {
            if ($this->checkTarget()) {
                throw new \Exception("Missing target site!");
            }

            // set target site
            $this->setTarget($target);

            if ($this->isCustomDriver()) {
                $this->custom_driver_result = $this->getDriver()->scrape($target, $this->options);
            } else {
                $this->document = $this->getDriver()->scrape($target, $this->options);
            }
        } catch (Exception $e) {
            $this->document = ['error' => $e];
        }

        return $this;
    }

    /**
     * 
     */
    public function parse($parsers = [])
    {
        if ($this->isCustomDriver()) {
            $this->addOptions([
                'custom_driver' => true
            ]);

            $this->useDriver('hquery');

            $this->document = $this->getDriver()->scrape($this->custom_driver_result, $this->options);
        }

        if (count($parsers) == 0) {
            $parsers = $this->parsers;
        } else {
            $tmpParsers = [];
            foreach($parsers as $parser) {
                $tmpParsers[$parser] = $this->parsers[$parser]; 
            }
            $parsers = $tmpParsers;
        }

        foreach ($parsers as $parser => $fn) {
            // check if is closure instance
            $this->result[$parser] = ($fn instanceof \Closure) ?
                $fn($this->document, $parser) :
                Parser::parse($this->document, $parser, $this->custom_regexes, $this->parser_options);
        }

        return $this;
    }

    /**
     * check if target is set
     * 
     * @return boolean
     */
    public function checkTarget()
    {
        return $this->target ? true : false;
    }
}
