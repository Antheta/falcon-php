<?php

namespace Antheta\Falcon;

use Antheta\Falcon\Config\App;
use Antheta\Falcon\Utils;
use Antheta\Falcon\Parser;
use Antheta\Falcon\Traits\CoreHelpers;
use Antheta\Falcon\Traits\DriverControl;
use Antheta\Falcon\Traits\HasOptions;
use Antheta\Falcon\Traits\ParserControl;
use Exception;

class Core extends Utils
{
    use HasOptions, CoreHelpers, ParserControl, DriverControl;

    public $target;

    public $result = [];

    public $document = [];

    protected $parsers = [];
    protected $drivers = [];

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
            // check if is closure instance
            $this->result[$parser] = ($fn instanceof \Closure) ?
                $fn($this->document, $parser) :
                Parser::parse($this->document, $parser);
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
}
