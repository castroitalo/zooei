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
    public function getBoardCategories(
        ?int $limit = null,
        ?int $offset = null,
        string $columns = "*"
    ): array|false|string
    {
        return $this->dao->getData($limit, $offset, $columns);
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
