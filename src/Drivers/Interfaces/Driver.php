<?php

namespace Antheta\Falcon\Drivers\Interfaces;

interface Driver {
    /**
     * The scrape method should get the dom from target site
     */
    public function scrape(string $target);

    /**
     * The method should recursively go through every dom element
     */
    public function recursive($html);

    /**
     * This method is for parsing the dom
     */
    public function parse();
}