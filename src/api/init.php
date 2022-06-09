<?php 

ob_start();
session_start();

function autoload_classes($class) {
  include dirname(dirname(dirname(__FILE__))) . '/src/' . $class . '.class.php';
}
 
spl_autoload_register('autoload_classes');

require dirname(dirname(__FILE__)) . '/../src/config/App.php';
require dirname(dirname(__FILE__)) . '/../src/config/Email.php';
require dirname(dirname(__FILE__)) . '/../src/config/IpAddress.php';
require dirname(dirname(__FILE__)) . '/../src/Scraper.class.php';

// autoload
require_once(dirname(dirname(__FILE__)) ."/../vendor/autoload.php"); 

?>
