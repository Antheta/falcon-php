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
                preg_match_all($regex, $node->html(), $candidates);
                if (!isset($candidates[0])) {
                    continue;
                }

                foreach ($candidates[1] as $i => $candidate) {
                    $ip = $candidates[1];
                    $port = $candidates[2];
                    if (Validator::ip($candidate)) {
                        if (!in_array($candidate, $ip_addresses_checker)) {
                            $ip_addresses_checker[] = $candidate;
                            $ip_addresses[] = array(
                                'ip_address' => $ip[$i],
                                'port' => $port[$i],
                                'match' => $candidate,
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