<?php

declare(strict_types=1);

namespace src\models;

use SebastianBergmann\Type\FalseType;
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
     * Get all board's post
     *
     * @param integer $postBoardId
     * @return array|false|string
     */
    public function getAllBoardPosts(int $postBoardId): array|false|string
    {
        $posts = $this->dao->getData(
            "*",
            "WHERE post_board_id=:post_board_id AND post_parent IS NULL
                ORDER BY post_created_at DESC",
            "post_board_id={$postBoardId}",
            10
        );

        return $posts;
    }

    /**
     * Get post by it's owner hash
     *
     * @param string $postOwner
     * @return object|false|string
     */
    public function getPostByOwner(string $postOwner): object|false|string
    {
        $post = $this->dao->getSingleData(
            "*",
            "WHERE post_owner=:post_owner",
            "post_owner={$postOwner}"
        );

        return $post;
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
     * Delete post based on it's ID
     *
     * @param integer $postId
     * @return true|string
     */
    public function deletePost(int $postId): true|string
    {
        $deletedPost = $this->dao->deleteData(
            "WHERE post_id=:post_id",
            "post_id={$postId}"
        );

        return $deletedPost;
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
            $this->deletePost($newPost);

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
