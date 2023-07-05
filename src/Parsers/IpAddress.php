<?php

namespace Antheta\Falcon\Parsers;

use Antheta\Falcon\Config\IpAddressConfig;
use Antheta\Falcon\Parsers\Interfaces\ParserInterface;
use Antheta\Falcon\Traits\RegexControl;
use Antheta\Falcon\Validator;

class IpAddress extends IpAddressConfig implements ParserInterface
{
    use RegexControl;

    public function parse(array $input): array 
    {
        if (!$input) {
            return [];
        }

        $ip_addresses = [];
        $ip_addresses_checker = [];
        foreach ($this->regex() as $regex) {
            foreach ($input as $node) {
                preg_match_all($regex, $node->html(), $m);
                if (!isset($m[0])) {
                    continue;
                }

                foreach ($m[1] as $i => $match) {
                    $ip = $m[1];
                    $port = $m[2];
                    if (Validator::ip($match)) {
                        if (!in_array($match, $ip_addresses_checker)) {
                            $ip_addresses_checker[] = $match;
                            $ip_addresses[] = array(
                                'ip_address' => $ip[$i],
                                'port' => $port[$i],
                                'match' => $match,
                                'ip' => $ip[$i] . ':' . $port[$i]
                            );
                        }
                    }
                }
            }
        }

        return $ip_addresses;
    }
}