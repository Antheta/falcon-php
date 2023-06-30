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
			"email" => \Antheta\Falcon\Parsers\Email::class,
			"phonenumber" => \Antheta\Falcon\Parsers\Phonenumber::class,
			"ipaddress" => \Antheta\Falcon\Parsers\IpAddress::class,
			"form" => \Antheta\Falcon\Parsers\Form::class,
			"link" => \Antheta\Falcon\Parsers\Link::class,
			"image" => \Antheta\Falcon\Parsers\Image::class,
			"stylesheet" => \Antheta\Falcon\Parsers\Stylesheet::class,
			"script" => \Antheta\Falcon\Parsers\Script::class,
			"font" => \Antheta\Falcon\Parsers\Font::class,
		]

	;

}


?>