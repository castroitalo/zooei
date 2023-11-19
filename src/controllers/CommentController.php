<?php

declare(strict_types=1);

namespace src\controllers;

use src\core\BaseControllerCore;
use src\core\RequestCore;
use src\core\ResponseCore;
use src\models\CommentModel;

/**
 * Class CommentController
 * 
 * @package src\controllers
 */
class CommentController extends BaseControllerCore
{
    /**
     * Extreact new comment data
     *
     * @param array $commentParent
     * @param array $uploadImageInfo
     * @param array $commentText
     * @return array|false
     */
    private function extractNewCommentData(
        array $commentParent,
        array $uploadImageInfo,
        array $commentText
    ): array|false {
        if ($commentParent === [] || $commentText === []) {
            return false;
        }

        $owner = generate_owner();
        $uploadImage = empty($uploadImageInfo["comment_image"]["name"])
            ? null
            : generate_image_filename($uploadImageInfo["comment_image"], $owner);

        return [
            "comment_parent" => $commentParent["parent"],
            "comment_owner" => $owner,
            "comment_image" => $uploadImage,
            "comment_text" => $commentText["comment_text"],
            "comment_created_at" => date("d/m/Y - H:i")
        ];
    }

    /**
     * Create a new comment
     *
     * @return void
     */
    public function createNewComment(): void
    {
        $commentParent = RequestCore::getGetRequestBody();
        $uploadImageInfo = RequestCore::getUploadBody();
        $commentText = RequestCore::getPostRequestBody();
        $commentData = $this->extractNewCommentData(
            $commentParent,
            $uploadImageInfo,
            $commentText
        );

        if ($commentData === false) {
            $this->setNewFlash("Dados do comentário inválidos.", CONF_FLASH_DANGER);
            ResponseCore::setResponseStatusCode(409);
            ResponseCore::redirectTo("/post?owner=" . $commentParent["parent"]);
        } else {
            $newComment = (new CommentModel())->createNewComment($commentData, $uploadImageInfo);

            if (is_string($newComment)) {
                $this->setNewFlash($newComment, CONF_FLASH_DANGER);
                ResponseCore::setResponseStatusCode(409);
                ResponseCore::redirectTo("/post?owner=" . $commentParent["parent"]);
            } else {
                $this->setNewFlash("Comentário criado com sucesso.", CONF_FLASH_SUCCESS);
                ResponseCore::redirectTo("/post?owner=" . $commentParent["parent"]);
            }
        }
    }
}
