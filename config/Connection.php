<?php
namespace Config;

use Dotenv\Dotenv;
use PDO;

class Connection 
{
    private static $db;

    public function connection()
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/..');
        $dotenv->load();
    
        $DB_CONNECTION = $_ENV['DB_CONNECTION'];
        $DB_HOST = $_ENV['DB_HOST'];
        $DB_CHARSET = $_ENV['DB_CHARSET'];
        $DB_DATABASE = $_ENV['DB_DATABASE'];
        $DB_USERNAME = $_ENV['DB_USERNAME'];
        $DB_PASSWORD = $_ENV['DB_PASSWORD'];

        return new PDO("$DB_CONNECTION:host=$DB_HOST;dbname=$DB_DATABASE;charset=$DB_CHARSET", $DB_USERNAME, $DB_PASSWORD);
    }

    /*
        Using Singleton For Creating just one instance
    */

    public function getInstance()
    {
        if (self::$db === null)
        {
            self::$db = $this->connection();
        }
        return self::$db;
    }
}
?>
