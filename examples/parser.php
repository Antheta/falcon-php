<?php

require_once dirname(__DIR__) . "/vendor/autoload.php";

use Antheta\Falcon\Falcon;

$url = "http://127.0.0.1/email-crawler/examples/tmp/index.html";

// example usage
$falcon = Falcon::getInstance();

// now lets add a new custom parser
$falcon->addParser("test", fn ($payload) => parsePhonenumbers($payload));

function parsePhonenumbers($input) {
    $content = $input["doc"];

    $phonenumbers = [];
    foreach ($content as $node) {
        if (
            $node->find("a") &&
            $node->find("a")->attr("href") &&
            strpos($node->find("a")->attr("href"), 'tel:') !== false
        ) {
            $phonenumber = $node->find("a")->attr("href");
            preg_match_all("/([\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,12})/", $phonenumber, $matches);
            foreach ($matches[0] as $m) {
                if (!in_array($m, $phonenumbers)) {
                    $phonenumbers[] = $m;
                }
            }
        }
    }

    return $phonenumbers;
}

// and now lets scrape the site and run all the parsers
$results = $falcon->run($url)->parse()->results();

// print results
print_r($results);