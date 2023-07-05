<?php

namespace Antheta\Falcon\Drivers\Interfaces;

interface DriverInterface {
    /**
     * The scrape method should get the dom from target site
     */
    public function scrape(string $target, array $options): array;
}