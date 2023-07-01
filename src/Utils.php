<?php

namespace Antheta\Falcon;

use Antheta\Falcon\Traits\CoreHelpers;
use Antheta\Falcon\Traits\DriverControl;
use Antheta\Falcon\Traits\OptionsControl;
use Antheta\Falcon\Traits\ParserControl;

abstract class Utils
{
    use OptionsControl, CoreHelpers, ParserControl, DriverControl;

    protected $driver = null;
    protected $custom_regexes = [];
    protected $options = [];

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
