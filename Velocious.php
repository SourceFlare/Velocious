<?php declare(strict_types=1);

namespace Velocious;

use Velocious\core\Router;
use Velocious\core\Exception;

require_once(__DIR__ . "/core/autoload.php");


/**
 * Determine how URL is being passed - get
 * url from input.
 */
!empty($_REQUEST['url']) ? $url=$_REQUEST['url'] : $url=substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], '.php') + 4);

/**
 * Find Route and Prepare Variables
 */
$App = new Router ($url);
$App->execute();
