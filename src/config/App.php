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
	

		// ** driver paths
		SIMPLE_HTML_DOM = "../vendor/simple_html_dom/simple_html_dom.php",
		CASPERJS = "",

		DRIVERS = [
			"simple_html_dom" => [
				"path" => "../vendor/simple_html_dom/simple_html_dom.php"
			],
			"hquery" => [
				"path" => "../vendor/simple_html_dom/simple_html_dom.php"
			],
			"casperjs" => [
				"path" => ""
			]
		],

		// ** driver in use
		DRIVER = "simple_html_dom",

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