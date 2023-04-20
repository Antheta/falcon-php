<?php

use duzun\hQuery;

class hQueryDriver extends Driver
{

    public $content;

    public $result;

    public $configuration = [
        'method' => 'GET',
        'useragent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.150 Safari/537.36'
    ];

    /**
     * The scrape method should 
     */
    public function scrape(string $target) {
        $doc = hQuery::fromFile($target, false, $this->getContext());

        if ($doc && $doc->find('html')) {
            return $this->recursive($doc->find('html'));
        }
    }

    public function recursive() {
        if (isset($html) && !empty($html)) {
            preg_match_all('/<head>|<body>|<div>|<a>/im', $html, $fmatches);
            foreach ($fmatches as &$fmatch) {
                foreach ($fmatch as $key => $el) {
                    $node = $html->find(str_replace('>', '', str_replace('<', '', $el)));
                    preg_match_all('/<head>|<body>|<div>|<a>/im', $node->html(), $smatch);

                    if (!is_array($node)) {
                        $this->content[] = $node->html() ? $node->html() : $node;
                    }
                }
            }
        }

        return $this->content;
    }

    public function parse($key = null, $parsers = []) {
        if (count($parsers) == 0) {
            $parsers = $parsers;
        }

        foreach ($parsers as $parser => $fn) {
            if (in_array($parser, $parsers)) {
                if (function_exists("{$fn}")) {
                    $this->result[$parser] = $fn($this->result);
                }
            }
        }

        if ($key) {
            return (isset($this->result[$key])) ? $this->result[$key] : $this->result;
        } else {
            return $this->result;
        }
    }

    public function getContext()
    {
        return stream_context_create([
            'http' => [
                'method' => $this->configuration['method'],
                'user_agent' => $this->configuration['useragent'],
                'header' => [],
            ]
        ]);
    }
}