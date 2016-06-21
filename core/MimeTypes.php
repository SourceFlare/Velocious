<?php declare(strict_types=1);

namespace Borris\core;
use Borris\core\Exception;


class MimeTypes {
    /**
     * Sets the appropriate document mime type
     * @param string $mime
     * @return bool
     */
    public static function set_mime_type (string $mime_type) : bool {
        switch ($mime_type) {
            case "json":
                $mime = 'application/json';
                break;
            case 'xml':
                $mime = 'application/xml';
                break;
            case 'html':
                $mime = 'text/html';
                break;
            case 'css':
                $mime = 'text/css';
                break;
            case 'javascript':
                $mime = 'application/javascript';
                break;
            case 'text':
            case 'plain':
                $mime = 'text/plain';
                break;
            default:
                $mime = 'application/octet-stream';
                break;
        }
        if(header('Content-Type: ' . $mime))
            return true;
        return false;
    }
}
