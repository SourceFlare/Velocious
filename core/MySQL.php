<?php declare(strict_types=1); namespace Velocious\core;


class MySQL
{
    # MySQL Object
    public $CONN;

    # Connection parameters
    const DRIVER_OPTIONS = [

    ];


    /** MySQL constructor **/
    public function __construct (string $host, string $port, string $database, string $charset, string $user, string $pass) {

        # Generate the DSN string
        $dsn = "mysql:dbname=$database;host=$host;port=$port";

        # Instantiate the MySQL Connection
        $this->CONN = new \PDO($dsn, $user, $pass, self::DRIVER_OPTIONS);
    }

    /** MySQL Destructor **/
    public function __destruct () {
        $this->CONN = null;
    }
}