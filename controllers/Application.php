<?php  declare(strict_types=1);

namespace Velocious\controllers;

use Velocious\core\MimeTypes;
use Velocious\core\Exception;


class Application
{
    protected $state;

    /**
     * Controller constructor.
     * @param array $state
     */
    public function __construct (array $state) {
        $this->state = $state;
    }

    /**
     * Send message to TxtLocal API via Services Server
     * @return string
     */
    public function homePage () {

        # Define a message
        $version = "2.0.5";
        
        # Return results
        return $version;
    }
}
