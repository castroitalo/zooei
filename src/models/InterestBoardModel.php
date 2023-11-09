<?php 

declare(strict_types=1);

namespace src\models;

use src\core\DaoCore;

/**
 * Class InterestBoardModel
 * 
 * @package src\models
 */
class InterestBoardModel 
{
    /**
     * Base dao
     *
     * @var DaoCore
     */
    private DaoCore $dao;

    /**
     * InterestBoardModel::__construct
     *
     * @param DaoCore|null $dao
     */
    public function __construct(?DaoCore $dao = null)
    {
        $this->dao = $dao ?? new DaoCore($_ENV["DB_BOARD_INTERESTS"]);
    }

    /**
     * Get interest board categories
     *
     * @param integer|null $limit
     * @param integer|null $offset
     * @param string $columns
     * @return array|false|string
     */
    public function getInterestsBoardCategories(
        ?int $limit = null,
        ?int $offset = null,
        string $columns = "*"
    ): array|false|string
    {
        return $this->dao->getData($limit, $offset, $columns);
    }

    /**
     * InterestBoardModel::$dao getter
     *
     * @return DaoCore
     */
    public function getDao(): DaoCore
    {
        return $this->dao;
    }
}
