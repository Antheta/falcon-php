<?php

namespace Antheta\Falcon\Traits;

trait DriverControl
{
    /**
     * Add a custom drivers
     * 
     * @param array $drivers
     * @return \Antheta\Falcon\Core
     */
    public function addDrivers($drivers): \Antheta\Falcon\Core
    {
        foreach ($drivers as $driver => $class) {
            $this->addDriver($driver, $class);
        }

        return $this;
    }

    public function addDriver($driver, $class): \Antheta\Falcon\Core
    {
        $this->drivers[$driver] = $class;
        
        return $this;
    }
}
