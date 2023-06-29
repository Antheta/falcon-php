<?php 

namespace Antheta\Falcon\Examples;

use Antheta\Falcon\Falcon;

//require_once dirname(__DIR__) . "/src/Falcon.php";

$url = "http://127.0.0.1/email-crawler/examples/tmp/index.html";

// example usage
$scraper = Falcon::getInstance()->run($url)->get();

print_r($scraper);