<?php

declare(strict_types=1);

namespace src\core;

use PDO;
use PDOException;

/**
 * Class DatabaseCore
 * 
 * @package src\core
 */
class DatabaseCore
{
    /**
     * Database connection
     *
     * @var PDO|null
     */
    private static ?PDO $databaseConnection = null;

    /**
     * PDO settings
     *
     * @var array
     */
    private static array $pdoSettings = [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ];

    /**
     * DBConnection constructor
     */
    final public function __construct()
    {
    }

    /**
     * DBConnection clone
     *
     * @return void
     */
    final public function __clone(): void
    {
    }

    /**
     * Get database connection 
     *
     * @return PDO|string
     */
    public static function getDatabaseConnection(): PDO|string
    {
        if (is_null(self::$databaseConnection)) {
            try {
                self::$databaseConnection = new PDO(
                    "mysql:host=" . $_ENV["DB_HOST"] . 
                        ";dbname=" . $_ENV["DB_NAME"] . 
                        ";port=" . $_ENV["DB_PORT"],
                    $_ENV["DB_USER"],
                    $_ENV["DB_PASSWORD"],
                    self::$pdoSettings
                );
            } catch (PDOException $ex) {
                error_log($ex->getMessage());

                return "This service is currently unvaliable. Please Try again later.";
            }
        }

        return self::$databaseConnection;
    }
}
