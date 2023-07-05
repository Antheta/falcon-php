<?php

namespace Antheta\Falcon\Config;

use Antheta\Falcon\Parsers\Modifiers\EmailCandidateModifier;

class EmailConfig
{
	protected array $custom_regexes = [];

	protected array $modifiers = [
		EmailCandidateModifier::class
	];

	protected array $default_regexes = [
		'/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i',
		'/[\._a-zA-Z0-9-]+\(at\)[\._a-zA-Z0-9-]+/i',
		'/[a-z0-9_\-\+\.]+[[:blank:]]\(at\)[[:blank:]]+[a-z0-9\-]+\.([a-z]{2,4})(?:\.[a-z]{2})?/i',
		'/[a-z0-9_\-\+\.]+[[:blank:]]@[[:blank:]]+[a-z0-9\-]+\.([a-z]{2,4})(?:\.[a-z]{2})?/i',
		'/[a-z0-9_\-\+\.]+@[[:blank:]]+[a-z0-9\-]+\.([a-z]{2,4})(?:\.[a-z]{2})?/i',
		'/[a-z0-9_\-\+\.]+[[:blank:]]@+[a-z0-9\-]+\.([a-z]{2,4})(?:\.[a-z]{2})?/i',
		'/[a-z0-9_\-\+\.]+[[:blank:]]\([[:blank:]]at[[:blank:]]\)[[:blank:]]+[a-z0-9\-]+\.([a-z]{2,4})(?:\.[a-z]{2})?/i',
		'/[a-z0-9_\-\+\.]+[[:blank:]]\([[:blank:]]@[[:blank:]]\)[[:blank:]]+[a-z0-9\-]+\.([a-z]{2,4})(?:\.[a-z]{2})?/i',
		'/[a-z0-9_\-\+\.]+\([[:blank:]]at[[:blank:]]\)+[a-z0-9\-]+\.([a-z]{2,4})(?:\.[a-z]{2})?/i',
		'/[a-z0-9_\-\+\.]+\([[:blank:]]@[[:blank:]]\)+[a-z0-9\-]+\.([a-z]{2,4})(?:\.[a-z]{2})?/i',
		'/[a-z0-9_\-\+\.]+\([[:blank:]]at\)+[a-z0-9\-]+\.([a-z]{2,4})(?:\.[a-z]{2})?/i',
		'/[a-z0-9_\-\+\.]+\([[:blank:]]@\)+[a-z0-9\-]+\.([a-z]{2,4})(?:\.[a-z]{2})?/i',
		'/[a-z0-9_\-\+\.]+\(at[[:blank:]]\)+[a-z0-9\-]+\.([a-z]{2,4})(?:\.[a-z]{2})?/i',
		'/[a-z0-9_\-\+\.]+\(@[[:blank:]]\)+[a-z0-9\-]+\.([a-z]{2,4})(?:\.[a-z]{2})?/i',
		'/[a-z0-9_\-\+\.]+\(at\)[a-z0-9\-]+\.([a-z]{2,4})(?:\.[a-z]{2})?/i',
		'/[a-z0-9_\-\+\.]+\%at\%[a-z0-9\-]+\.([a-z]{2,4})(?:\.[a-z]{2})?/i',
		'/[a-z0-9_\-\+\.]+\%@\%[a-z0-9\-]+\.([a-z]{2,4})(?:\.[a-z]{2})?/i',
		'/[a-z0-9_\-\+\.]+\%\(at\)\%[a-z0-9\-]+\.([a-z]{2,4})(?:\.[a-z]{2})?/i',
		'/[a-z0-9_\-\+\.]+\(ät\)[a-z0-9\-]+\.([a-z]{2,4})(?:\.[a-z]{2})?/i'
	];

	protected array $at_signs = [
		'@',
		'@ ',
		' @',
		'(at)',
		'[at]',
		' [at] ',
		'[ät]',
		' (at) ',
		' (at)',
		'(at) ',
		'%20(at)%20',
		'%at%',
		'%(at)%',
		'(ät)',
		'&#28450;',
		'&#23383;'
	];

	protected function regex(): array
	{
		return array_merge($this->default_regexes, $this->custom_regexes);
	}

	public function at_signs(): array
	{
		return $this->at_signs;
	}

}