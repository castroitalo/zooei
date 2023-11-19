<?php

declare(strict_types=1);

namespace src\models;

use src\core\DaoCore;

/**
 * Class CommentModel
 * 
 * @package src\models
 */
class CommentModel
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
        $this->dao = $dao ?? new DaoCore($_ENV["DB_COMMENTS_TBL"]);
    }

    /**
     * Upload a new comment image file
     *
     * @param array $commentImageFileInfo
     * @param string $imageFilename
     * @return boolean
     */
    private function uploadImageComment(
        array $commentImageFileInfo,
        string $imageFilename
    ): bool {
        if ($commentImageFileInfo["comment_image"]["error"] === 0) {
            $destination = CONF_UPLOAD_COMMENTS_IMAGE_PATH . $imageFilename;

            if (move_uploaded_file($commentImageFileInfo["comment_image"]["tmp_name"], $destination)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Create a new comment
     *
     * @param array $newCommentData
     * @return integer|string
     */
    public function createNewComment(array $newCommentData, array $commentImageFileInfo): int|string
    {
        $newComment = $this->dao->createData($newCommentData);

        if (is_string($newComment)) {
            return "Falha ao criar comentário.";
        }

        if (!is_null($newCommentData["comment_image"])) {
            $newCommentImage = $this->uploadImageComment(
                $commentImageFileInfo,
                $newCommentData["comment_image"]
            );

            if ($newCommentImage === false ) {
                return "Falha ao criar comentário.";
            }
        }

        return $newComment;
    }

    /**
     * Get all post's comments
     *
     * @param string $commentParent
     * @return array|false|string
     */
    public function getAllPostComments(string $commentParent): array|false|string
    {
        $comments = $this->dao->getData(
            "*",
            "WHERE comment_parent=:comment_parent ORDER BY comment_created_at DESC",
            "comment_parent={$commentParent}",
            10
        );

        return $comments;
    }
}
