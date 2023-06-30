<?php

namespace Antheta\Falcon\Config;

class PhonenumberConfig
{
	public $custom_regexes = [];

	public function regex() {
		return [
			'/([\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,12})/',
			...$this->custom_regexes
 	   ];
	}

}


?>