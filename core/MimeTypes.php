<?php declare(strict_types=1);

namespace Velocious\core;

use Velocious\core\Exception;


class MimeTypes {
    /**
     * Sets the appropriate document mime type
     * @param string $mime
     * @return bool
     */
    public static function setMimeType (string $mimeType) : bool {
        switch ($mimeType) {
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
    

    /**
     * Sets the appropriate document mime type via function call
     */
    public static function json       () { self::setMimeType ("json");       }
    public static function xml        () { self::setMimeType ("xml");        }
    public static function html       () { self::setMimeType ("html");       }
    public static function css        () { self::setMimeType ("css");        }
    public static function javascript () { self::setMimeType ("javascript"); }
    public static function text       () { self::setMimeType ("text");       }
    public static function plain      () { self::setMimeType ("plain");      }
}
