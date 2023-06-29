<?php

namespace Antheta\Falcon;

abstract class Utils
{
    protected $driver = null;

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
    protected function getDriver()
    {
        return $this->driver;
    }
}
