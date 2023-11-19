<?php

declare(strict_types=1);

namespace src\controllers;

use src\core\BaseControllerCore;
use src\core\RequestCore;
use src\core\ResponseCore;
use src\models\BoardModel;
use src\models\CommentModel;
use src\models\PostModel;

/**
 * Class PostController
 * 
 * @package src\controllers
 */
class PostController extends BaseControllerCore
{
    /**
     * Extract new post data
     *
     * @param array $boardUri
     * @param array $uploadImageInfo
     * @param array $postText
     * @return array|false
     */
    private function extractnewPostData(
        array $boardUri,
        array $uploadImageInfo,
        array $postText
    ): array|false {
        if (
            $boardUri === [] ||
            empty($uploadImageInfo["post_image"]["name"]) ||
            $postText === []
        ) {
            return false;
        }

        $boardObject = (new BoardModel())
            ->getBoardByUri("/" . $boardUri["board"]);

        if (is_object($boardObject)) {
            $postBoardId = $boardObject->board_id;
            $postOwner = generate_owner();
            $postImagePath = generate_image_filename(
                $uploadImageInfo["post_image"],
                $postOwner
            );
            $postText = $postText["post_text"];

            return [
                "post_board_id" => $postBoardId,
                "post_owner" => $postOwner,
                "post_image" => $postImagePath,
                "post_text" => $postText,
                "post_created_at" => date("d/m/Y - H:i")
            ];
        }

        return false;
    }

    /**
     * Upload and register new post
     *
     * @return void
     */
    public function createNewPost(): void
    {
        $boardUri = RequestCore::getGetRequestBody();
        $uploadImageInfo = RequestCore::getUploadBody();
        $postText = RequestCore::getPostRequestBody();
        $newPostData = $this->extractnewPostData(
            $boardUri,
            $uploadImageInfo,
            $postText
        );

        if ($newPostData === false) {
            $this->setNewFlash("Dados do post inválidos.", CONF_FLASH_DANGER);
            ResponseCore::setResponseStatusCode(409);
            ResponseCore::redirectTo("/" . $boardUri["board"]);
        } else {
            $newPost = (new PostModel())->createNewPost(
                $newPostData,
                $uploadImageInfo
            );

            if (is_string($newPost)) {
                $this->setNewFlash($newPost, CONF_FLASH_DANGER);
                ResponseCore::setResponseStatusCode(409);
                ResponseCore::redirectTo("/" . $boardUri["board"]);
            } else {
                $this->setNewFlash("Post criado com sucesso.", CONF_FLASH_SUCCESS);
                ResponseCore::redirectTo("/" . $boardUri["board"]);
            }
        }
    }

    /**
     * Render post page 
     *
     * @return void
     */
    public function postPage(): void
    {
        $postOwner = RequestCore::getGetRequestBody();
        $post = (new PostModel())
            ->getPostByOwner($postOwner["owner"]);
        $postComments = (new CommentModel()) 
            ->getAllPostComments($postOwner["owner"]);

        if ($post === false || is_string($post)) {
            ResponseCore::setResponseStatusCode(404);
            ResponseCore::redirectTo("/pagenotfound");
        } else {
            $this->controllerView->render(
                "post.view",
                [
                    "post_title" => "Post",
                    "post_data" => $post,
                    "post_comments" => $postComments
                ]
            );
        }
    }
}
