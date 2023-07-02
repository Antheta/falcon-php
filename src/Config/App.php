<?php

namespace Antheta\Falcon\Config;

class App
{
	
	const

		// ** default drivers
		DRIVERS = [
			"hquery" => \Antheta\Falcon\Drivers\hQueryDriver::class,
		],

		// ** default driver
		DRIVER = "hquery",

		// ** default parsers
		PARSERS = [
			"metadata" => \Antheta\Falcon\Parsers\Metadata::class,
			"email" => \Antheta\Falcon\Parsers\Email::class,
			"phonenumber" => \Antheta\Falcon\Parsers\Phonenumber::class,
			"ipaddress" => \Antheta\Falcon\Parsers\IpAddress::class,
			"form" => \Antheta\Falcon\Parsers\Form::class,
			"link" => \Antheta\Falcon\Parsers\Link::class,
			"image" => \Antheta\Falcon\Parsers\Image::class,
			"stylesheet" => \Antheta\Falcon\Parsers\Stylesheet::class,
			"script" => \Antheta\Falcon\Parsers\Script::class,
			"table" => \Antheta\Falcon\Parsers\Table::class,
		]

	;

}