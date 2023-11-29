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
     */
    public function __construct(?string $databaseTable = null)
    {
        $this->dao = new DaoCore($databaseTable ?? $_ENV["DB_BOARDS_TBL"]);
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
    ): array|false|string {
        $boards = $this->dao->getData($columns, $where, $whereParams, $limit, $offset);

        if (is_string($boards)) {
            return "Falha ao carregar interesses. Tente novamente mais tarde";
        }

        return $boards;
    }

    /**
     * Get board based on it's URI
     *
     * @param string $boarUri
     * @param string $columns
     * @return object|false|string
     */
    public function getBoardByUri(
        string $boarUri,
        string $columns = "*"
    ): object|false|string {
        $where = "WHERE board_uri=:board_uri";
        $whereParams = "board_uri={$boarUri}";
        $board = $this->dao->getSingleData($columns, $where, $whereParams);

        return $board;
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
