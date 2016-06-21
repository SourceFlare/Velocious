<?php declare(strict_types=1);

namespace Borris\core;

use Borris\core\MimeTypes;
use Borris\core\Exception;


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
