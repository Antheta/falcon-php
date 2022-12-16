<?php

namespace marcosraudkett;

/**
 * Phonenumber Configuration
 *
 * @author     Marcos Raudkett <info@marcosraudkett.com>
 * @copyright  2023 Marcos Raudkett
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @version    0.1.0
 */

class Phonenumber
{

	public static function regex() {
		return [
			'/([\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,12})/',
 	   ];
	}

}


?>