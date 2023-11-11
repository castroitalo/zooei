<?php 

declare(strict_types=1);

namespace src\models;

use src\core\DaoCore;

/**
 * Class BoardModel
 * 
 * @package src\models
 */
class BoardModel 
{
    /**
     * Base dao
     *
     * @var DaoCore
     */
    private DaoCore $dao;

    /**
     * BoardModel::__construct
     *
     * @param DaoCore|null $dao
     */
    public function __construct(string $boardDatabaseTable, ?DaoCore $dao = null)
    {
        $this->dao = $dao ?? new DaoCore($boardDatabaseTable);
    }

    /**
     * Get board categories
     *
     * @param integer|null $limit
     * @param integer|null $offset
     * @param string $columns
     * @return array|false|string
     */
    public function getBoards(
        string $columns = "*",
        string $where = "",
        string $whereParams = "",
        ?int $limit = null,
        ?int $offset = null
    ): array|false|string
    {
        return $this->dao->getData($columns, $where, $whereParams, $limit, $offset);
    }

    /**
     * BoardModel::$dao getter
     *
     * @return DaoCore
     */
    public function getDao(): DaoCore
    {
        return $this->dao;
    }
}
