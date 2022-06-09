<?php 

// api for scraper
header("Access-Control-Allow-Origin: *");

require_once __DIR__ . '/init.php';
require_once __DIR__ . '/../../vendor/bramus/router/src/Bramus/Router/Router.php';

// Create a Router
$router = new \Bramus\Router\Router();
// Scraper
$scraper = new Scraper();

$router->before('GET|POST', '/.*', function () {
    header('X-Powered-By: Crawler');
});

// test if router works
$router->get('/test', function() {
    print_r("works");
});

// scrape route
$router->get('/scrape', function() use($scraper) {
    if (isset($_GET["url"])) {
        // run and return JSON response
        $scraper->run($_GET["url"])->responseJson();
    } else {
        $scraper->response(["message" => "Missing URL parameter"]);
    }
});


$router->run();