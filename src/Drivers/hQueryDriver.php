<?php

namespace Antheta\Falcon\Drivers;

use duzun\hQuery;
use Antheta\Falcon\Drivers\Interfaces\DriverInterface;

class hQueryDriver implements DriverInterface
{
    public $content;

    protected $options;

    public function scrape(string $target, $options = []) {
        $this->options = $options;

        if (isset($options['custom_driver'])) {
            $doc = hQuery::fromHTML(
                $target
            );
        } else {
            $doc = hQuery::fromURL(
                $target,
                isset($options['headers']) ? $options['headers'] : [],
                $this->getContext()
            );
        }
        
        if ($doc) {
            return $this->recursive(isset($options['custom_driver']) ? $doc : $doc->find('html'));
        }
    }

    public function recursive($html) {
        if (isset($html) && !empty($html)) {
            preg_match_all('/<head>|<body>|<div>|<a>/im', $html, $fmatches);
            foreach ($fmatches as &$fmatch) {
                foreach ($fmatch as $key => $el) {
                    $node = $html->find(str_replace('>', '', str_replace('<', '', $el)));
                    preg_match_all('/<head>|<body>|<div>|<a>/im', $node->html(), $smatch);

                    $this->content[] = !is_array($node) ? $node : [];
                }
            }
        }

        return $this->content;
    }

    public function getContext()
    {
        return stream_context_create([
            'http' => [
                'method' => isset($this->options['method']) ? $this->options['method'] : '',
                'user_agent' => isset($this->options['useragent']) ? $this->options['useragent'] : '',
                'header' => [],
            ]
        ]);
    }
}