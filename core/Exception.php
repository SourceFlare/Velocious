<?php declare(strict_types=1);

namespace Velocious\core;


class Exception {
    
    /**
     * Sets the status code required, then dies with the error.
     */
    public static function cast ($message, $response_code) {
        http_response_code($response_code);
        echo "Error $response_code.\n\n";
        echo "$message";
        die();
    }
}
