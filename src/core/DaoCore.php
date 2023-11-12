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
        string $columns = "*",
        string $where = "",
        string $whereParams = "",
        ?int $limit = null,
        ?int $offset = null
    ): array|false|string {
        try {
            $sql = "SELECT {$columns} FROM {$this->databaseTable} {$where}";

            // If a limit was passed
            if (!is_null($limit)) {
                $sql .= "LIMIT {$limit}";

                // If a offset was passed
                if (!is_null($offset)) {
                    $sql .= ", {$offset}";
                }
            }

            $stmt = $this->databaseConnection->prepare($sql);

            // If a where was passed
            if (!empty($where)) {
                parse_str($whereParams, $whereParamsArray);

                foreach ($whereParamsArray as $key => $value) {
                    $valueType = is_string($value) ? PDO::PARAM_STR : PDO::PARAM_INT;

                    $stmt->bindValue(":{$key}", $value, $valueType);
                }
            }

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (PDOException $ex) {
            error_log($ex->getMessage());

            return "Failed to get data. Try again later.";
        }
    }

    /**
     * Get a single data from database
     *
     * @param string $columns
     * @param string $where
     * @param string $whereParams
     * @return object|false|string
     */
    public function getSingleData(
        string $columns = "*",
        string $where = "",
        string $whereParams = ""
    ): object|false|string {
        try {
            $sql = "SELECT {$columns} FROM {$this->databaseTable} {$where}";
            $stmt = $this->databaseConnection->prepare($sql);

            if (!empty($where)) {
                parse_str($whereParams, $whereParamsArray);

                foreach ($whereParamsArray as $key => $value) {
                    $valueType = is_string($value) ? PDO::PARAM_STR : PDO::PARAM_INT;

                    $stmt->bindValue(":{$key}", $value, $valueType);
                }
            }

            $stmt->execute();

            return $stmt->fetchObject();
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
