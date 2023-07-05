<?php

require_once dirname(__DIR__) . "/tests/WarmupTests.php";

$results = $falcon->parse()->results();

print_r($results);

it('can parse html', function () use($falcon) {
    $results = $falcon->parse()->results();

    print_r($results);
});