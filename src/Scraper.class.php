<?php

// Optionally use namespaces
use duzun\hQuery;

/**
 *
 *
 * PHP version 7
 *
 * @author     Marcos Raudkett <info@marcosraudkett.com>
 * @copyright  2022 Marcos Raudkett
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @version    2.0.0
 */

class Scraper extends Utils
{

    /**
     * Target website
     */
    public $target;
    public $result;
    public $configuration;

    private static $_instance; //singleton instance

    private $currentUser; //current signed in user object

    private function __clone() {} //disallow cloning the class

    public function __construct($target = null) 
    {
        if (isset($target)) $this->target = $target;
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
     * @return void
     */
    public function run($target = null) { 
        if (!$this->checkTarget()) {

            // set target site
            $this->setTarget($target);

            $this->result = [
                "message" => "works"
            ];
            
        } else {
            $this->response(["message" => "Missing URL parameter"]);
        }
    }

    /**
     * set config
     */
    public function config() { }
    
    /**
     * Response in JSON
     * 
     * @return json
     */
    public function responseJson()
    {
        $this->response($result);
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