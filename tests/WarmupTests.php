<?php

require_once dirname(__DIR__) . "/vendor/autoload.php";

$htmlDocument = dirname(__DIR__) . "/tests/test.html";

$html = file_get_contents($htmlDocument);

$falcon = \Antheta\Falcon\Falcon::getInstance();

$falcon->addDrivers(["testDriver" => null]);
$falcon->useDriver("testDriver");
$falcon->addOptions(["custom_driver" => true]);

$falcon->run($html);