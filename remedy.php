<?php  declare(strict_types=1);

namespace Velocious;

use Velocious\core\Exception;


class Remedy {

    /**
     * Registers a new service in Velocious
     * @param string $ServiceName
     */
    final public static function createNewService (string $ServiceName) {
        // TODO
    }


    /**
     * Registers a new route in Velocious
     * @param string $path
     * @param int $TLSOnly
     * @param int $AllowFrom
     */
    final public static function createNewRoute (string $path, int $TLSOnly, int $AllowFrom) {
        // TODO
    }


    /**
     * Modifies a route so that it only accepts TLS traffic
     * @param string $route
     */
    final public static function makeRouteTLSOnly (string $route) {
        // TODO
    }
}
