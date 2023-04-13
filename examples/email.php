<?php 

namespace marcosraudkett;

require_once dirname(__DIR__) . "/src/Scraper.class.php";

$url = "http://127.0.0.1/email-crawler/examples/tmp/index.html";

// example usage
$scraper = SimplScraper::getInstance()->run($url)->get();

print_r($scraper);