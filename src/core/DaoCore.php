<?php

declare(strict_types=1);

namespace src\core;

use PDO;
use PDOException;

/**
 * Class DaoCore
 * 
 * @package src\core
 */
class DaoCore
{
    /**
     * Database table to manage data
     *
     * @var string
     */
    private string $databaseTable;

    /**
     * Database connection
     *
     * @var PDO|null
     */
    private ?PDO $databaseConnection;

    /**
     * DaoCore::__construct
     *
     * @param string $databaseTable
     * @param PDO|null $databaseConnection
     */
    public function __construct(
        string $databaseTable,
        ?PDO $databaseConnection = null
    ) {
        $this->databaseTable = $databaseTable;
        $this->databaseConnection = $databaseConnection ?? DatabaseCore::getDatabaseConnection();
    }

    /**
     * Get data from database. It's possible to get based on a pagination logic 
     *
     * @param integer|null $limit
     * @param integer|null $offset
     * @param string $columns
     * @return array|false|string
     */
    public function getData(
        ?int $limit = null,
        ?int $offset = null,
        string $columns = "*"
    ): array|false|string {
        try {
            $sql = "SELECT {$columns} FROM {$this->databaseTable}";

            // If a limit was passed
            if (!is_null($limit)) {
                $sql .= "LIMIT {$limit}";

                // If a offset was passed
                if (!is_null($offset)) {
                    $sql .= ", {$offset}";
                }
            }

            $stmt = $this->databaseConnection->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (PDOException $ex) {
            error_log($ex->getMessage());

            return "Failed to get data. Try again later.";
        }
    }

    /**
     * DaoCore::$databaseTable getter
     *
     * @return string
     */
    public function getDatbaseTable(): string 
    {
        return $this->databaseTable;
    }

    /**
     * DataCore::$databaseConnection getter
     *
     * @return PDO|null
     */
    public function getDatabaseConnection(): ?PDO
    {
        return $this->databaseConnection;
    }
}
