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

    /**
     * Create new post
     *
     * @param array $newPostData
     * @return integer|string
     */
    public function createNewPost(array $newPostData): int|string 
    {
        $newPost = $this->dao->createData($newPostData);
    
        if (is_string($newPost)) {
            return "Falha ao criar post.";
        }

        return $newPost;
    }

    /**
     * PostModel::$dao getter
     *
     * @return DaoCore
     */
    public function getDao(): DaoCore
    {
        return $this->dao;
    }
}
