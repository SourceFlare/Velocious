<?php declare(strict_types=1);

namespace Velocious\core;

use Velocious\core\MimeTypes;
use Velocious\core\Exception;


class Render {
    /**
     * Renders view in JSON
     * @param string $json
     * @return bool
     */
    public static function json (array $data) : bool {
        MimeTypes::json();
        echo json_encode($data);
        return true;
    }
    
    /**
     * Renders view in JSON
     * @param string $json
     * @return bool
     */
    public static function file (string $filename, string $mime_type) : bool {
        MimeTypes::set_mime_type($mime_type);
        echo file_get_contents($filename);
        return true;
    }
}
