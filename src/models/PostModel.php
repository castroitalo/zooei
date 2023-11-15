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
     * Upload a new post image file
     *
     * @param array $postImageFileInfo
     * @param string $imageFilename
     * @return boolean
     */
    private function uploadImagePost(array $postImageFileInfo, string $imageFilename): bool
    {
        if ($postImageFileInfo["post_image"]["error"] === 0) {
            $destination = CONF_UPLOAD_POSTS_IMAGE_PATH . $imageFilename;

            if (move_uploaded_file($postImageFileInfo["post_image"]["tmp_name"], $destination)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Create new post
     *
     * @param array $newPostData
     * @return integer|string
     */
    public function createNewPost(array $newPostData, array $postImageFileInfo): int|string
    {
        // Create post on database
        $newPost = $this->dao->createData($newPostData);

        if (is_string($newPost)) {
            return "Falha ao criar post.";
        }

        // Upload post image file
        $newPostImage = $this->uploadImagePost($postImageFileInfo, $newPostData["post_image"]);

        if ($newPostImage === false) {
            return "Falha ao criar post.";
        }

        return $newPost;
    }

    public function getAllBoardPosts(int $postBoardId): array|false|string
    {
        $posts = $this->dao->getData(
            "post_board_id, 
                post_owner, 
                post_image, 
                post_text, 
                DATE_FORMAT(post_created_at, \"%d/%m/%Y %H:%i\") AS post_created_at",
            "WHERE post_board_id=:post_board_id",
            "post_board_id={$postBoardId}",
            10
        );

        return $posts;
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
