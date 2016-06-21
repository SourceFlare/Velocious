<?php declare(strict_types=1);

namespace Borris\core;

use Borris\core\Render;
use Borris\core\MimeTypes;
use Borris\core\Exception;

class Router {
    
    public static $state = [];
    public static $route;
    
    /**
     * Matches the URL against a defined route
     * @param string $url
     * @param array $routes
     * @return bool
     */
    public static function find_route (string $url) : bool {
        
        # Load Routes from Config File
        if(!require_once(__DIR__ . "/../config/Routes.php"))
            Exception::cast ("Error 500 - Could not load routes file.", 500);
        
        # Run through routes and find a match
        foreach ($route as $r => $f) {
            
            # Get the preg_math patterns
            $patterns = self::build_matching_patterns ($r);
            
            # Run both patterns
            $result1 = preg_match($patterns['scalar_pattern'], $r, $scalars);
            $result2 = preg_match($patterns['url_pattern'], $url, $parts);
            
            # Check that match ws ok
            if (!$result1 or !$result2)
                continue;
            
            # Build variables
            $i=0;
            foreach ($scalars as $s) {
                self::$state[$s] = $parts[$i];
                $i++;
            }
            
            # Put route into state
            self::$route = $f;
            
            return true;
        }
        Exception::cast("Could not find route.", 404);
        return false;
    }
    
    /**
     * Builds the two required preg_match patterns required to extract
     * required variables from the route and the url, then puts those
     * values from the URL into those defined variable names in the 
     * abstracted route definition.
     * @param string $abstracted_url
     * @return array
     */
    final protected static function build_matching_patterns (string $abstracted_url) : array {
            # Build a pattern for the Route
            $url_pattern = '/' . preg_replace(
                "/{([a-zA-Z0-9\-\_\%\&\;]*)}/i", 
                "([a-zA-Z0-9\-\_\%\&\;]*)",
                str_replace('/', '\/', $abstracted_url)
            ) . '$/i';
            
            # Modify pattern to extract details from URL
            $scalar_pattern = str_replace(
                "([a-zA-Z0-9\-\_\%\&\;]*)", 
                "{([a-zA-Z0-9\-\_\%\&\;]*)\}",
                $url_pattern
            );
            
            return [
                'url_pattern'      => $url_pattern,
                'scalar_pattern' => $scalar_pattern
            ];
    }
    
    /**
     * Returns the Route's closure to be executed
     * @return object closure
     */
    final public static function execute () {
        $action = self::$route;
        
        # Check that route is available
        if(!isset(self::$route))
            Exception::cast ("Could not execute route!", 500);
        
        # Execute route!
        $action(self::$state);
    }
    
}
