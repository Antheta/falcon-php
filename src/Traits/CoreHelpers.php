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
}
