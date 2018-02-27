<?php declare(strict_types=1);

namespace Velocious\core;

use Velocious\interfaces\RouterInterface;
use Velocious\core\Render;
use Velocious\core\MimeTypes;
use Velocious\core\Exception;
use Velocious\core\Rules;


class Router {
    
    public $state = [];
    public $route;
    
    /**
     * Constructs the url into the class
     * @param string $url
     */
    public function __construct (string $url) {
    	if (!isset($url))
    		Exception::cast("Error! No url was given.\n\nYour server rewriting configuration may be incorrect.\n\nPlease check and try again.", 500);
    	$this->state['requested_url'] = urldecode($url);
    }
    
    /**
     * Matches the URL against a defined route
     * @param string $url
     * @param array $routes
     * @return bool
     */
    final public function findRoute () : Router {
    	
    	# You are using Velocious; be awesome!
    	header("X-Powered-By: Velocious!");
        
        # Load Routes from Config File
        if(!require_once(__DIR__ . "/../routes/config.php"))
            Exception::cast ("Could not load routes file.", 500);
        
        # Run through routes and find a match
        foreach ($route as $r => $obj) {
            
            # Get the preg_math patterns
            $patterns = $this->buildMatchingPatterns ($r);
            
            # Run both patterns
            $result1 = preg_match($patterns['scalar_pattern'], $r,   $scalars);
            $result2 = preg_match($patterns['url_pattern'],    $this->state['requested_url'], $parts);
            
            # Check that match ws ok
            if (!$result1 or !$result2)
                continue;
            
            # Set the state
			$this->setState($scalars, $parts);
            
            # Check for governance compliance
            Rules::govern($obj);
            
            # Put route into state
            $this->route = $obj;
            
            # Return the class 
            # for other operations.
            return $this;
        }
        Exception::cast("Could not find route.", 404);
    }
    
    /**
     * Builds the two required preg_match patterns required to extract
     * required variables from the route and the url, then puts those
     * values from the URL into those defined variable names in the 
     * abstracted route definition.
     * @param string $abstracted_url
     * @return array
     */
    final protected function buildMatchingPatterns (string $abstracted_url) : array {
            # Build a pattern for the Route
            $url_pattern = '/^' . preg_replace(
                "/{([a-zA-Z0-9\.\-\_\%\&\;]*)}/i", 
                "([a-zA-Z0-9\.\-\_\%\&\;]*)",
                str_replace('/', '\/', $abstracted_url)
            ) . '$/i';
            
            # Modify pattern to extract details from URL
            $scalar_pattern = str_replace(
                "([a-zA-Z0-9\.\-\_\%\&\;]*)", 
                "{([a-zA-Z0-9\.\-\_\%\&\;]*)\}",
                $url_pattern
            );
            
            return [
                'url_pattern'    => $url_pattern,
                'scalar_pattern' => $scalar_pattern
            ];
    }
    
    /**
     * Returns the Route's closure to be executed
     * @return object closure
     */
    final public function execute () {
    	
    	# Locate the route, and instantiate the state
    	$this->findRoute();
    	
		# Check that the state is set
		if (!isset($this->state) or empty($this->state))
			Exception::cast ("Error! State has not been set!", 500);
    	
        # Check that route is available
        if(!isset($this->route))
            Exception::cast ("Could not execute route!", 500);
		
        # Retrieve controller from route
        $action = $this->route['Controller'];
            
        # Execute route!
        $action($this->state);
    }
    
    
    /**
     * Sets the state object with the various vairbles
     * such as URL matching, GET & POST, and others
     * such as Superglobals (_SERVER, _SESSION, etc)
     * @param array $scalars
     * @return bool
     */
    final protected function setState (array $scalars, array $parts) : bool {
        # Put URL variables into the State
        $i=0;
        foreach ($scalars as $s) {                 # Variables from URL
            $this->state[$s] = $parts[$i]; $i++; }
        
        # Put GET and POST variables into the state
        foreach ($_REQUEST as $key => $value) {    # Variables from GET & POST
            $this->state[$key] = $value; }
        
        # Reference super globals into State
   	    $this->state['SERVER']  = &$_SERVER;
   	    $this->state['FILES']   = &$_FILES;
        $this->state['COOKIE']  = &$_COOKIE;
  	    $this->state['SESSION'] = &$_SESSION;
  	    
  	    return true;
    }
}
