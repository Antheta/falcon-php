<?php

namespace marcosraudkett;

require_once "Validator.class.php";

// configs
require_once "config/Email.php";
require_once "config/IpAddress.php";
require_once "config/Phonenumber.php";

/**
 * Parser for the Scraper
 *
 * @author     Marcos Raudkett <info@marcosraudkett.com>
 * @copyright  2023 Marcos Raudkett
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @version    0.1.0
 */

class Parser extends Validator
{

    public static function email($nodes): array
    {
        $nodes = $nodes["content"];
        $emails = [];
        foreach (Email::regex() as $regex) {
            foreach ($nodes as $node) {
                preg_match_all($regex, $node, $matches);
                foreach ($matches[0] as $m) {
                    $r = str_replace(Email::at_signs(), "@", $m);
                    if (Validator::email($r)) {
                        if (!in_array($m, $emails)) {
                            $emails[] = $m;
                        }
                    }
                }
            }
        }

        return $emails;
    }

    public static function ip($nodes)
    {
        $nodes = $nodes["content"];
        $ip_addresses = [];
        $ip_addresses_checker = [];
        foreach (IpAddress::regex() as $regex) {
            foreach ($nodes as $node) {
                preg_match_all($regex, $node, $m);
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

    public static function phonenumber($nodes)
    {
        $nodes = $nodes["doc"];
        $phonenumbers = [];
        foreach ($nodes as $node) {
            if (
                $node->find("a") &&
                $node->find("a")->attr("href") &&
                strpos($node->find("a")->attr("href"), 'tel:') !== false
            ) {
                $phonenumber = $node->find("a")->attr("href");
                foreach (Phonenumber::regex() as $regex) {
                    preg_match_all($regex, $phonenumber, $matches);
                    foreach ($matches[0] as $m) {
                        print_r($m);
                        if (!in_array($m, $phonenumbers)) {
                            $phonenumbers[] = $m;
                        }
                    }
                }
            }
        }

        return $phonenumbers;
    }

    public static function form()
    {
    }
    public static function link()
    {
    }
    public static function image()
    {
    }
    public static function stylesheet()
    {
    }
    public static function script()
    {
    }
    public static function font()
    {
    }
}
