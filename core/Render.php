<?php declare(strict_types=1);

namespace Velocious\core;

use Velocious\core\MimeTypes;
use Velocious\core\Exception;


class Render {
    /**
     * Renders in JSON
     * @param string $json
     * @return bool
     */
    public static function json (array $data) : bool {
        MimeTypes::json();
        echo json_encode($data);
        return true;
    }
    
    /**
     * Renders in XML
     * @param string $json
     * @return bool
     */
    public static function xml (array $data) : bool {
        MimeTypes::xml();
        echo xmlrpc_encode ($data);
        return true;
    }

    /**
     * Renders HTML
     * @param string $html
     * @return bool
     */
    public static function html (string $html) : bool {
        MimeTypes::html();
        echo $html;
        return true;
    }

    /**
     * Renders nominated file
     * @param string $json
     * @return bool
     */
    public static function file (string $filename, string $mime_type) : bool {
        MimeTypes::set_mime_type($mime_type);
        
        # Strips directory climbers
        $filename = str_replace ("../", "", $filename);
        $filename = str_replace ("./", "", $filename);
        $filename = ltrim ($filename, "/");
        
        # Check file exists
        if (!file_exists($filename))
        	Exception::cast("Could not find requested file", 404);
        
        # Load file
        $content = file_get_contents($filename);
        
        # Check loaded
        if (empty($content))
        	Exception::cast("Requested file was empty.", 404);
        
        # Return HTML to browser
        echo $content;
        return true;
    }
}
