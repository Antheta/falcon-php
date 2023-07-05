<?php

namespace Antheta\Falcon\Config;

class PhonenumberConfig
{
	protected array $custom_regexes = [];

	protected array $default_regexes = [
		'/([\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,12})/'
	];

	protected function regex(): array
	{
		return array_merge($this->default_regexes, $this->custom_regexes);
	}
}


?>