<?php

namespace Antheta\Falcon;

abstract class Utils
{
    protected $driver = null;

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
