<?php

namespace Antheta\Falcon\Drivers;

use duzun\hQuery;
use Antheta\Falcon\Drivers\Interfaces\DriverInterface;

class hQueryDriver implements DriverInterface
{
    public $content;

    public $result;

    protected $options;

    public function scrape(string $target, $options = []) {
        $this->options = $options;

        $doc = hQuery::fromURL(
            $target, 
            isset($options['headers']) ? $options['headers'] : [], 
            $this->getContext()
        );
        
        if ($doc && $doc->find('html')) {
            return $this->recursive($doc->find('html'));
        }
    }

    public function recursive($html) {
        if (isset($html) && !empty($html)) {
            preg_match_all('/<head>|<body>|<div>|<a>/im', $html, $fmatches);
            foreach ($fmatches as &$fmatch) {
                foreach ($fmatch as $key => $el) {
                    $node = $html->find(str_replace('>', '', str_replace('<', '', $el)));
                    preg_match_all('/<head>|<body>|<div>|<a>/im', $node->html(), $smatch);

                    if (!is_array($node)) {
                        $this->content["content"][] = $node->html() ? $node->html() : $node;
                        $this->content["doc"][] = $node;
                    }
                }
            }
        }

        return $this->content;
    }

    public function getContext()
    {
        return stream_context_create([
            'http' => [
                'method' => $this->options['method'],
                'user_agent' => $this->options['useragent'],
                'header' => [],
            ]
        ]);
    }
}