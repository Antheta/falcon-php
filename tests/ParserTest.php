<?php

require_once dirname(__DIR__) . "/tests/WarmupTests.php";

$results = $falcon->parse()->results();

// TODO: add better validations here

print_r($results['ipaddress']);

// email
it('can parse emails', function () use($results) {
    foreach($results["email"] as $item) {
        expect($item)->toBeString();
    }
});

// ip address
// it('can parse ip addresses', function () use($results) {
    // foreach($results["ipaddress"] as $item) {
    //     expect($item)->toBeArray();
    // }

    // expect($results["ipaddress"][0]["ip"])->toBe("127.0.0.1:23");
// });

// phonenumbers
it('can parse phonenumbers', function () use($results) {
    expect($results["phonenumber"][0])->toBe("+358527249444");
});

// links
it('can parse links', function () use($results) {
    expect($results["link"][0])->toBe("https://google.com");
});

// images
it('can parse images', function () use($results) {
    expect($results["image"][0])->toBe("nice.png");
});

// stylesheets
it('can parse stylesheets', function () use($results) {
    expect($results["stylesheet"][0])->toBe("/style.css");
});

// scripts
it('can parse scripts', function () use($results) {
    expect($results["script"][0])->toBe("/hello.js");
});