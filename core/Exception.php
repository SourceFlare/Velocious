<?php declare(strict_types=1);

namespace Velocious\core;


class Exception {
    /**
     * Sets the status code required, then dies with the error.
     * @param string $message
     * @param int $response_code
     */
    public static function cast ($message, $responseCode) {
        http_response_code($responseCode);
        header("Content-type: text/plain");
        echo "Error $responseCode.\n\n";
        echo "$message";
        die();
    }
}
