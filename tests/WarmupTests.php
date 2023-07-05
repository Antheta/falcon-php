<?php

require_once dirname(__DIR__) . "/vendor/autoload.php";

$htmlDocument = dirname(__DIR__) . "/tests/test.html";

$html = file_get_contents($htmlDocument);

$falcon = \Antheta\Falcon\Falcon::getInstance();

$falcon->addDrivers(["Test" => null]);
$falcon->useDriver("test");

$falcon->setResult($html);

$falcon->getDriver()->scrape($html, ["custom_driver" => true]);