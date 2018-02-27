<?php declare(strict_types=1);

namespace Velocious\config;

use Velocious\core\Exception;


/**
* Protected class for the list of Remote Addresses allowed
* to access the Services APIs
*/
class Restricted {


    # List of remote addresses that can access the APIs
    protected static $remote_addresses = [
        "127.0.0.1",    # Localhost
        "::1",          # Localhost (IPv6)
    ];


    # Getter for the Restricted List of Remote Addresses
    final public static function getRemoteAddresses () : array {
        return self::$remote_addresses;
    }
}
