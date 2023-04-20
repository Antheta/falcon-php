<?php

namespace marcosraudkett\Traits;

trait Options {
    public function setUserAgent($userAgent) {
        $this->configuration["useragent"] = $userAgent;
    }

    public function setMethod($method) {
        $this->configuration["method"] = $method;
    }

    public function setConfiguration($configuration) {
        $this->configuration = $configuration;
    }
}