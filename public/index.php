<?php

use PHPFramework\Application;
use Symfony\Component\VarDumper\Cloner\Data;

ini_set('desplay_errors', 1);
error_reporting(E_ALL);


require_once __DIR__ . '/../config/config.php';
require_once ROOT . '/vendor/autoload.php';
require_once HELPERS . '/helpers.php';


$app = new Application();
require_once CONFIG . '/routes.php';

$app->run();

class Database
{

    private static $instance = null;
    private $connection = null;

    protected function __construct()
    {
        $this->connection = new PDO(
            "mysql:host=" . DBHOST . ";dbname=" . DBNAME . ";charset=utf8",
            DBLOGIN,
            DBPASS,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]
            );
    }

    protected function __clone()
    {
    }

    public function __wakeup()
    {
        throw new BadFunctionCallException('Unable to deserialize database connetion');
    }

    public static function getInstance(): Database
    {
        if (is_null(self::$instance))
        {
            return self::$instance = new static();
        }

        return self::$instance;
    }

    public static function connection(): PDO
    {
        return static::getInstance()->connection;
    }

    public static function query(string $statement): PDOStatement
    {
        return static::connection()->prepare($statement);
    }

}



