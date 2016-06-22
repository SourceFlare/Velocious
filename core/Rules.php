<?php declare(strict_types=1);

namespace Velocious\core;

use Velocious\core\Exception;


class Rules {
	
	/**
	 * Checks the constraints for the route denies access if triggered
	 * @param array $constraints
	 * @return bool
	 */
	public static function govern (array $route) {
		
		# If rules not set then skip
		if (!isset($route['Rules']))
			return true;
		
		# Check request type is on the allowed list for this route
		if (!self::check_alowed_request_types ($route['Rules']))
			Exception::cast ("Incorrect request type for this route.", 405);
		
		# Check remote addr is on the allowed list
		if (!self::check_alowed_remote_addr ($route['Rules']))
			Exception::cast ("Access is forbidden.", 403);		
	}

	/**
	 * Checks that request type is on the allowed list
	 * @param array $list
	 * @return bool
	 */
	protected static function check_alowed_request_types (array $rules) : bool {
		
		# If not set then return (skip)
		if (!isset($rules['Allowed_Request_Types']))
			return true;
		
		# Check ok
		if (in_array($_SERVER['REQUEST_METHOD'], $rules['Allowed_Request_Types']))
			return true;
		return false;
	}
	
	/**
	 * Checks that remote ADDR is on the allowed list
	 * @param array $list
	 * @return bool
	 */
	protected static function check_alowed_remote_addr (array $rules) : bool {
		
		# If not set then skip
		if (!isset($rules['Allowed_Remote_Addr']))
			return true;
		
		# Determine IP address of client
		$ipAddress = $_SERVER['REMOTE_ADDR'];
		if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
			$ipAddress = array_pop(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']));
		}
		
		# Check that client is on the OK list
		if (in_array($ipAddress, $rules['Allowed_Remote_Addr']))
			return true;
		return false;
	}
}
