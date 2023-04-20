<?php

interface Driver {
    /**
     * The scrape method should get the dom from target site
     */
    public function scrape();

    /**
     * The method should recursively go through every element
     */
    public function recursive();

    /**
     * This method is for parsing the dom
     */
    public function parse();
}