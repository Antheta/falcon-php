<?php

namespace marcosraudkett;

/**
 * Utils for the Scraper
 *
 * @author     Marcos Raudkett <info@marcosraudkett.com>
 * @copyright  2023 Marcos Raudkett
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @version    0.1.0
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

    /**
     * Get the specific driver
     * 
     * @param string $driver_name
     * @return mixed
     */
    protected function getDriver($driver_name)
    {

    }
}
