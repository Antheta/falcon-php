<?php

namespace Antheta\Falcon\Traits;

trait OptionsControl
{
    protected array $options = [];
    
    public function addHeaders(array $headers): void
    {
        foreach ($headers as $header) {
            $this->addHeader($header);
        }
    }

    public function addHeader(string $header): void
    {
        $this->options['headers'][] = $header;
    }

    public function addCookies(array $cookies): void
    {
        foreach ($cookies as $cookie) {
            $this->addHeader($cookie);
        }
    }

    public function addCookie(string $name, string $value): void
    {
        $this->options['cookies'][$name] = $value;
    }

    public function setUseragent(string $userAgent): void
    {
        $this->options['useragent'] = $userAgent;
    }

    public function setMethod(string $method): void
    {
        $this->options['method'] = $method;
    }

    public function addOptions(array $options): void
    {
        $this->options = array_merge($this->options, $options);
    }

    public function setOptions(array $options): void
    {
        $this->options = $options;
    }
}
