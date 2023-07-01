<?php

namespace Antheta\Falcon\Config;

class PhonenumberConfig
{
	public $custom_regexes = [];

	protected $default_regexes = [
		'/([\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,12})/'
	];

	public function regex()
	{
		return array_merge($this->default_regexes, $this->custom_regexes);
	}
}


?>