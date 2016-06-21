<?php declare(strict_types=1);

namespace Velocious\core;

use Velocious\core\MimeTypes;
use Velocious\core\Exception;


class Render {
    /**
     * Renders view in JSON
     * @param string $json
     */
    public static function json (array $data) {
        MimeTypes::set_mime_type('json');
        die(json_encode($data));
    }
}
