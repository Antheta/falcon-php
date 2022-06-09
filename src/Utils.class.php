<?php

/**
 * Utils for the Scraper
 *
 * PHP version 7
 *
 * @author     Marcos Raudkett <info@marcosraudkett.com>
 * @copyright  2022 Marcos Raudkett
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @version    2.0.0
 */

abstract class Utils 
{

    /**
     * Response in JSON
     */
    public function response($response)
    {
        header('Content-type: application/json');
        echo json_encode($response);
    }

}