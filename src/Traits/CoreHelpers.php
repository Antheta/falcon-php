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

    public function emails(): array
    {
        return $this->getResult("email");
    }

    public function ipAddresses(): array
    {
        return $this->getResult("ipaddress");
    }

    public function phonenumbers(): array
    {
        return $this->getResult("phonenumber");
    }

    public function forms(): array
    {
        return $this->getResult("form");
    }

    public function links(): array
    {
        return $this->getResult("link");
    }

    public function images(): array
    {
        return $this->getResult("image");
    }

    public function stylesheets(): array
    {
        return $this->getResult("stylesheet");
    }

    public function scripts(): array
    {
        return $this->getResult("script");
    }

    public function fonts(): array
    {
        return $this->getResult("font");
    }

    public function tables(): array
    {
        return $this->getResult("table");
    }

    protected function getResult(string $key): array
    {
        return $this->result[$key];
    }

    public function results(): array
    {
        return $this->result;
    }
}
