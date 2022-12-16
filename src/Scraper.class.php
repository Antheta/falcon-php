<?php

namespace marcosraudkett;

// vendors
require_once dirname(__DIR__) . "/vendor/autoload.php";

// core
require_once "Utils.class.php";
require_once "Parser.class.php";

// config
require_once "config/App.php";

// Optionally use namespaces
use duzun\hQuery;
use Exception;

/**
 * Core
 *
 * @author     Marcos Raudkett <info@marcosraudkett.com>
 * @copyright  2023 Marcos Raudkett
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @version    0.1.0
 */

class Scraper extends Utils
{
    /**
     * Target website
     */
    public $target;
    public $result = [];
    public $configuration = [
        'method' => 'GET',
        'useragent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.150 Safari/537.36'
    ];

    private static $_instance; //singleton instance

    private function __clone()
    {
    } //disallow cloning the class

    public function __construct()
    {
    }

    /**
     * Get the singleton instance
     *
     * To access rest of non-static methods of class
     * @return Scraper
     */
    public static function getInstance()
    {
        if (self::$_instance === NULL) {
            self::$_instance = new Scraper();
        }

        return self::$_instance;
    }

    /**
     * Run Scraper
     * 
     * @param string $target
     * @return object
     */
    public function run($target = null): object
    {
        try {
            if (!$this->checkTarget()) {
                // set target site
                $this->setTarget($target);
                // scrape

                $scrape = $this->scrape();

                $this->result = $scrape;
            } else {
                $this->response(["message" => "Missing URL parameter"]);
            }
        } catch (Exception $e) {
            $this->result = ['error' => $e];
        }

        return $this;
    }

    public function getContext()
    {
        return stream_context_create([
            'http' => [
                'method' => $this->configuration['method'],
                'user_agent' => $this->configuration['useragent'],
                'header' => [],
            ]
        ]);
    }

    public function scrape()
    {
        $doc = hQuery::fromFile($this->target, false, $this->getContext());

        if ($doc && $doc->find('html')) {
            return $this->recursive($doc->find('html'));
        }
    }

    public function recursive($html)
    {
        if (isset($html) && !empty($html)) {
            preg_match_all('/<head>|<body>|<div>|<a>/im', $html, $fmatches);
            foreach ($fmatches as &$fmatch) {
                foreach ($fmatch as $key => $el) {
                    $node = $html->find(str_replace('>', '', str_replace('<', '', $el)));

                    //print_r($node->html());

                    preg_match_all('/<head>|<body>|<div>|<a>/im', $node->html(), $smatch);

                    if (is_array($smatch)) {
                        /* print_r("RECURSIVE_:");
                        print_r($node->html());
                        print_r("recursive: {$key}");  */
                        //$this->recursive($node);
                    }

                    if (!is_array($node)) {
                        $this->result["content"][] = $node->html() ? $node->html() : $node;
                    }
                }
            }
        }

        return $this->result;
    }

    /**
     * set config
     */
    public function config()
    {
    }

    /**
     * 
     */
    public function get($key = null, $parsers = [])
    {
        if (count($parsers) == 0) {
            $parsers = App::PARSERS;
        }

        foreach ($parsers as $parser) {
            if (in_array($parser, App::PARSERS)) {
                $this->result[$parser] = Parser::$parser($this->result["content"]);
            }
        }

        if ($key) {
            return (isset($this->result[$key])) ? $this->result[$key] : $this->result;
        } else {
            return $this->result;
        }
    }

    /**
     * Response in JSON
     * 
     * @return json
     */
    public function responseJson()
    {
        $this->response($this->result);
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
}
