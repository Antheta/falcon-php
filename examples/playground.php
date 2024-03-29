<?php

require_once dirname(__DIR__) . "/vendor/autoload.php";

use Antheta\Falcon\Falcon;

$url = "http://127.0.0.1/email-crawler/examples/tmp/index.html";

// example usage
$falcon = Falcon::getInstance();

$results = $falcon->run($url)->parse();

print_r($results->results());