<?php

require_once dirname(__DIR__) . "/vendor/autoload.php";

use Antheta\Falcon\Falcon;

$url = "http://127.0.0.1/email-crawler/examples/tmp/index.html";

// example usage
$scraper = Falcon::getInstance()->run($url)->parse()->emails();

print_r($scraper);