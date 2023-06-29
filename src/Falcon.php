<?php 

namespace Antheta\Falcon;

use Antheta\Falcon\Core;

/**
 * Falcon
 *
 * @author     Antheta Labs <info@antheta.com>
 * @copyright  2023 Antheta Labs
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @version    1.0.0
 * 
 */
class Falcon 
{
    // ** singleton instance
    private static $_instance;

    public function __construct()
    {  
    }

    public static function getInstance()
    {
        if (self::$_instance === NULL) {
            self::$_instance = new Core();
        }

        return self::$_instance;
    }

}