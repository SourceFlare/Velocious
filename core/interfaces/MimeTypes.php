<?php declare(strict_types=1); namespace Velocious\core\interfaces;


interface MimeTypes
{
    public static function set_mime_type (string $mime_type) : bool;
    public static function json       ();
    public static function xml        ();
    public static function html       ();
    public static function css        ();
    public static function javascript ();
    public static function text       ();
    public static function plain      ();
}
