<?php

namespace Antheta\Falcon\Traits;

trait CoreHelpers
{
    /**
     * get the target site
     * 
     * @return string
     */
    public function getTarget(): string
    {
        return $this->target;
    }
    
    /**
     * check if target is set
     * 
     * @param string $target
     */
    public function setTarget(string $target): void
    {
        if (isset($target)) $this->target = $target;
    }

    public function emails()
    {
        return $this->getResult("email");
    }

    public function ipAddresses()
    {
        return $this->getResult("ipaddress");
    }

    public function phonenumbers()
    {
        return $this->getResult("phonenumber");
    }

    public function forms()
    {
        return $this->getResult("form");
    }

    public function links()
    {
        return $this->getResult("link");
    }

    public function images()
    {
        return $this->getResult("image");
    }

    public function stylesheets()
    {
        return $this->getResult("stylesheet");
    }

    public function scripts()
    {
        return $this->getResult("script");
    }

    public function fonts()
    {
        return $this->getResult("font");
    }

    public function tables()
    {
        return $this->getResult("table");
    }

    protected function getResult($key) 
    {
        return $this->result[$key];
    }

    public function results()
    {
        return $this->result;
    }
}
