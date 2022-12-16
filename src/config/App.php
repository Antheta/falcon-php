<?php

namespace marcosraudkett;

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
		
		// ** driver in use
		DRIVER = SIMPLE_HTML_DOM,

		// ** driver paths
		SIMPLE_HTML_DOM = "../vendor/simple_html_dom/simple_html_dom.php",
		CASPERJS = "",

		PARSERS = [
			"email",
			"ip",
			"phonenumber",
			"form",
			"link",
			"image",
			"stylesheet",
			"script",
			"font",
		]

	;

}


?>