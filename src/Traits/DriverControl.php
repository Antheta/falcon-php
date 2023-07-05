<?php

namespace Antheta\Falcon\Traits;

use Antheta\Falcon\Config\App;

trait DriverControl
{
    protected array $drivers = App::DRIVERS;

    protected mixed $driver = null;
    
    protected mixed $default_driver = null;

    public function __construct()
    {
        $this->driver = new $this->drivers[App::DRIVER];
        $this->default_driver = new $this->drivers[App::DRIVER];
    }

    /**
     * Add a custom drivers
     * 
     * @param array $drivers
     * @return void
     */
    public function addDrivers(array $drivers): void
    {
        foreach ($drivers as $driver => $class) {
            $this->addDriver($driver, $class);
        }
    }

    /**
     * Add driver
     * 
     * @param string $driver
     * @param object $class
     * @return void
     */
    public function addDriver(string $driver, $class): void
    {
        $this->drivers[$driver] = $class;
    }

    /**
     * Use a specific driver
     * 
     * @param string $driver
     * @return void
     */
    public function useDriver(string $driver): void
    {
        if (isset($this->drivers[$driver])) {
            $this->driver = new $this->drivers[$driver];
        }
    }

    /**
     * Check if the current driver is a custom one
     * 
     * @return bool
     */
    public function isCustomDriver(): bool
    {
        if (!$this->driver instanceof \Antheta\Falcon\Drivers\hQueryDriver) {
            return true;
        }

        return false;
    }

    /**
     * Get a list of available drivers
     * 
     * @return array
     */
    public function getDrivers(): array
    {
        return $this->drivers;
    }

    /**
     * Get the specific driver
     * 
     * @param string $driver_name
     * @return mixed
     */
    public function getDriverInstance(): mixed
    {
        if ($this->driver->instance) {
            return $this->driver->instance;
        }

        return null;
    }

    public function setCustomDriverResult($html): void
    {
        $this->custom_driver_result = $html;
    }

    /**
     * Get the specific driver
     * 
     * @param string $driver_name
     * @return mixed
     */
    public function getDriver(): mixed
    {
        return $this->driver;
    }
}
