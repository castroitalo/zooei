<?php 

declare(strict_types=1);

namespace src\models;

use src\core\DaoCore;

/**
 * Class PostModel 
 * 
 * @package src\models
 */
class PostModel 
{
    /**
     * Base dao
     *
     * @var DaoCore
     */
    private DaoCore $dao;

    /**
     * PostModel::__construct
     *
     * @param DaoCore|null $dao
     */
    public function __construct(?DaoCore $dao = null)
    {
        $this->dao = $dao ?? new DaoCore($_ENV["DB_POSTS_TBL"]);
    }
}
