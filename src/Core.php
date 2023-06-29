<?php

namespace Antheta\Falcon;

use Antheta\Falcon\Config\App;
use Antheta\Falcon\Utils;
use Antheta\Falcon\Parser;
use Antheta\Falcon\Traits\HasOptions;
use Exception;

class Core extends Utils
{
    use HasOptions;

    /**
     * Target website
     */
    public $target;
    public $result = [];
    public $document = [];

    protected $parsers = [];
    protected $drivers = [];

    private static $_instance; //singleton instance

    private function __clone()
    {
    } //disallow cloning the class

    public function __construct()
    {
        $this->parsers = App::PARSERS;
        $this->drivers = App::DRIVERS;
        $this->driver = new $this->drivers[App::DRIVER];
    }

    /**
     * Run Scraper
     * 
     * @param string $target
     * @return Core
     */
    public function run($target = null) : Core
    {
        try {
            if (!$this->checkTarget()) {
                // set target site
                $this->setTarget($target);

                // scrape
                $this->document = $this->getDriver()->scrape($target);
            } else {
                $this->response(["message" => "Missing URL parameter"]);
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
            if (isset($this->parsers[$parser])) {
                if (method_exists(Parser::class, $parser)) {
                    $this->result[$parser] = Parser::$parser($this->document);
                } else {
                    if ($fn) {
                        $this->result[$parser] = $fn($this->document);
                    }
                }
            }
        }

        return $this->result;
    }

    /**
     * Response in JSON
     * 
     * @return json
     */
    public function responseJson()
    {
        $this->response($this->document);
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

    /**
     * check if target is set
     * 
     * @param string $target
     */
    public function setTarget($target)
    {
        if (isset($target)) $this->target = $target;
    }

    /**
     * Add a custom parser
     * 
     * @param string $parser
     * @param mixed $fn
     * @return Core
     */
    public function addParser($parser, $fn): Core
    {
        $this->parsers[$parser] = $fn;

        return $this;
    }

    public function disableParsers($parsers): Core
    {
        foreach($this->parsers as $parser) {
            foreach ($parsers as $parser) {
                if (in_array($parser, $this->parsers)) {
                    unset($this->parsers[$parser]);
                }
            }
        }

        return $this;
    }

    /**
     * Add a custom drivers
     * 
     * @param array $drivers
     * @return Core
     */
    public function addDrivers($drivers) : Core
    {
        foreach($drivers as $driver => $class) {
            $this->drivers[$driver] = $class;
        }

        return $this;
    }
}
