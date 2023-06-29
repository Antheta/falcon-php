<?php

namespace Antheta\Falcon\Config;

class Phonenumber
{

	public static function regex() {
		return [
			'/([\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,12})/',
 	   ];
	}

}


?>