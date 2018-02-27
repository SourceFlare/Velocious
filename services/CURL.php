<?php declare(strict_types=1); namespace Velocious\services;

use Velocious\core\Exception;


class CURL
{
    public static function commit (string $url, array $data) {
        try {
            # Perform cURL Operation to API Endpoint
            $http = \curl_init($url);

            if (FALSE === $http)
                Exception::cast('Could not initialize CURL.', 500);

            # Set Options
            \curl_setopt($http, CURLOPT_SSL_VERIFYPEER, false);
            \curl_setopt($http, CURLOPT_SSL_VERIFYHOST, 0);
            \curl_setopt($http, CURLOPT_POST, true);
            \curl_setopt($http, CURLOPT_POSTFIELDS, $data);
            \curl_setopt($http, CURLOPT_RETURNTRANSFER, true);

            # Execute Navigation
            $response = \curl_exec($http);
/**
            var_dump($url);
            var_dump($data);
            var_dump($http);
            var_dump(\curl_error($http));
            var_dump($response);
**/
        } catch(\Exception $e) {
            trigger_error(sprintf(
                'Curl failed with error #%d: %s',
                $e->getCode(), $e->getMessage()),
                E_USER_ERROR);
        }

        # Close Connection
        curl_close($http);

        # Return response
        return $response;
    }
}