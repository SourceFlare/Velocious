<?php declare(strict_types=1); namespace Velocious\core;

use Velocious\core\Exception;


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
    

    /**
     * Sets the appropriate document mime type via function call
     */
    public static function json       () { self::set_mime_type ("json");       }
    public static function xml        () { self::set_mime_type ("xml");        }
    public static function html       () { self::set_mime_type ("html");       }
    public static function css        () { self::set_mime_type ("css");        }
    public static function javascript () { self::set_mime_type ("javascript"); }
    public static function text       () { self::set_mime_type ("text");       }
    public static function plain      () { self::set_mime_type ("plain");      }
}
