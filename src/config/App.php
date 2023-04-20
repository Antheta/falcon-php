<?php

namespace marcosraudkett;

require_once dirname(__DIR__) . "/Parser.class.php";

/**
 * App Configuration
 *
 * @author     Marcos Raudkett <info@marcosraudkett.com>
 * @copyright  2023 Marcos Raudkett
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @version    0.1.0
 */

class App
{
	
	const

		/**
		 * List of drivers
		 */
		DRIVERS = [
			"hquery" => hQueryDriver::class,
			"simple_html_dom" => null,
			"casperjs" => null
		],

		// ** default driver
		DRIVER = "hquery",

		/**
		 * List of parsers
		 * 
		 * "name" => "function"
		 */
		PARSERS = [
			"email" => "Parser::email",
			"ip" => "Parser::ip",
			"phonenumber" => "Parser::phonenumber",
			"form" => "Parser::form",
			"link" => "Parser::link",
			"image" => "Parser::image",
			"stylesheet" => "Parser::stylesheet",
			"script" => "Parser::script",
			"font" => "Parser::font",
		]

	;

}


?>