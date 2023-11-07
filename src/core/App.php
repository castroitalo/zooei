<?php 

declare(strict_types=1);

namespace src\core;

use PDO;

/**
 * Class App 
 * 
 * @package src\core
 */
class App 
{
    /**
     * App's database connection
     *
     * @var PDO
     */
    private PDO $databaseConnection;

    /**
     * App constructor
     */
    public function __construct()
    {
        $this->databaseConnection = DatabaseCore::getDatabaseConnection();
    }

    /**
     * App::$databaseConnection getter
     *
     * @return PDO
     */
    public function getDatabaseConnection(): PDO
    {
        return $this->databaseConnection;
    }
}
