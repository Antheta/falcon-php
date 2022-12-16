<?php

namespace marcosraudkett;

/**
 * Validator
 *
 * @author     Marcos Raudkett <info@marcosraudkett.com>
 * @copyright  2023 Marcos Raudkett
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @version    0.1.0
 */

class Validator
{
    public static function email($payload)
    {
        return (filter_var($payload, FILTER_VALIDATE_EMAIL)) ? true : false;
    }

    public static function ip($payload)
    {
        return (filter_var($payload, FILTER_VALIDATE_IP)) ? true : false;
    }
}
