<?php declare(strict_types=1); namespace Velocious\core\interfaces;


interface ExceptionInterface
{
    public static function cast (string $message, int $response_code);
}