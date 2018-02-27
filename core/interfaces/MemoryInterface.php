<?php declare(strict_types=1); namespace Velocious\core\interfaces;


interface MemoryInterface
{
    public static function createCache (string $key, $value, int $ttl) : bool;
    public static function readCache (string $key);
    public static function deleteCache (string $key) : bool;
    public static function generateKey (string $key) : string;
    public static function Memcached () : \Memcached;
}