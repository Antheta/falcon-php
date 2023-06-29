<?php

namespace Antheta\Falcon\Config;

class App
{
	
	const

		/**
		 * List of drivers
		 */
		DRIVERS = [
			"hquery" => \Antheta\Falcon\Drivers\hQueryDriver::class,
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