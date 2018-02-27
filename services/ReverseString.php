<?php declare(strict_types=1);

namespace Velocious\services;

use Velocious\core\Exception;


class ReverseString {
	
	/**
	 * Reverses a strings character order
	 * @param string $string
	 * @return string
	 */
	public function commit (string $string) : string {
		return strrev($string);
	}
}