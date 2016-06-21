<?php declare(strict_types=1);

namespace Borris;

use Borris\core\Router;
use Borris\core\Exception;

require_once(__DIR__ . "/core/autoload.php");


/**
 * Find Route and Prepare Variables
 */
Router::find_route ($_REQUEST['url']);   # Find the route
Router::execute();                                # Execute the route!
