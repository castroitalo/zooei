<?php

declare(strict_types=1);

namespace src\controllers;

use src\core\BaseControllerCore;
use src\core\RequestCore;
use src\core\ResponseCore;
use src\models\BoardModel;
use src\models\PostModel;

/**
 * Class PostController
 * 
 * @package src\controllers
 */
class PostController extends BaseControllerCore
{
    /**
     * Render post page 
     *
     * @return void
     */
    public function postPage(): void
    {
        $getInfo = RequestCore::getGetRequestBody();

        // If doesn't have a post owner on request
        if (!isset($getInfo["owner"])) {
            ResponseCore::setResponseStatusCode(404);
            ResponseCore::redirectTo("/pagenotfound");
        }

        $post = (new PostModel())->getPostByOwner($getInfo["owner"]);

        // If failed to get post
        if ($post === false || is_string($post)) {
            ResponseCore::setResponseStatusCode(404);
            ResponseCore::redirectTo("/pagenotfound");
        }

        $commentsRepliesLimit = $getInfo["page"] * 10;
        $commentsReplies = (new PostModel())
            ->getAllCommentsReplies($getInfo["owner"], $commentsRepliesLimit);

        // If failed to get post's comments
        if ($commentsReplies === false || is_string($commentsReplies)) {
            ResponseCore::setResponseStatusCode(404);
            ResponseCore::redirectTo("/pagenotfound");
        }

        $this->controllerView->render(
            "post.view",
            [
                "post" => $post,
                "post_owner" => $getInfo["owner"],
                "post_page" => $getInfo["page"],
                "comments" => $commentsReplies
            ]
        );
    }

    /**
     * Extract new post data
     *
     * @param array $getInfo
     * @param array $uploadImageInfo
     * @param array $postText
     * @return array|false
     */
    private function extractnewPostData(
        array $getInfo,
        array $uploadImageInfo,
        array $postText
    ): array|false {
        // Check if all data are coming correctly
        if ($getInfo === [] || $postText === []) {
            return false;
        }

        // If post is not a child from another post
        if (!isset($getInfo["parent"])) {

            // Check if it has an image
            if (empty($uploadImageInfo["post_image"]["name"])) {
                return false;
            }
        }

        $postOwner = generate_owner();
        $postImage = empty($uploadImageInfo["post_image"]["name"])
            ? null
            : generate_image_filename($uploadImageInfo["post_image"], $postOwner);
        $postBoardId = null;

        // If post is not child from another post
        if (!isset($getInfo["parent"])) {

            // Get the post's board
            $postBoard = (new BoardModel())->getBoardByUri("/" . $getInfo["board"]);

            if (is_string($postBoard) || $postBoard === false) {
                return false;
            }

            $postBoardId = $postBoard->board_id;
        }

        // Get new post needed data
        $postParent = isset($getInfo["parent"])
            ? $getInfo["parent"]
            : null;
        $postText = $postText["post_text"];

        // Mount the new post data
        return [
            "post_board_id" => $postBoardId,
            "post_parent" => $postParent,
            "post_owner" => $postOwner,
            "post_image" => $postImage,
            "post_text" => $postText,
            "post_created_at" => date("d/m/Y - H:i:s")
        ];
    }

    /**
     * Create a new post
     *
     * @return void
     */
    public function createNewPost(): void
    {
        // Get base post info
        $getInfo = RequestCore::getGetRequestBody();
        $uploadImageInfo = RequestCore::getUploadBody();
        $postText = RequestCore::getPostRequestBody();

        // Get full formatted new post info
        $newPostData = $this->extractnewPostData(
            $getInfo,
            $uploadImageInfo,
            $postText
        );

        // If get formatted new post info fails
        if ($newPostData === false) {
            $this->setNewFlash("Falha ao criar nova postagem.", CONF_FLASH_DANGER);
            ResponseCore::setResponseStatusCode(409);
            ResponseCore::redirectTo("/" . $getInfo["board"]);

            // If get formatted new post info succeed
        } else {

            // Create a new post
            $newPost = (new PostModel())
                ->createNewPost($newPostData, $uploadImageInfo);
            $newPostOwnerIpAddress = RequestCore::getClientIpAddrress();

            // If create a new post fails
            if (is_string($newPost)) {
                $this->setNewFlash($newPost, CONF_FLASH_DANGER);
                ResponseCore::setResponseStatusCode(409);
                ResponseCore::redirectTo("/" . $getInfo["board"]);
            }

            // If the post was an original post
            if (isset($getInfo["board"])) {
                $this->setNewFlash("Postagem criada com sucesso.", CONF_FLASH_SUCCESS);
                error_log("Owner: {$newPostData["post_owner"]} - {$newPostOwnerIpAddress}");
                ResponseCore::redirectTo("/" . $getInfo["board"] . "?page=0");
            } 

            // If the post was a child post (comments and replies)
            if (isset($getInfo["parent"])) {
                $this->setNewFlash("Postagem criada com sucesso.", CONF_FLASH_SUCCESS);
                error_log("Owner: {$newPostData["post_owner"]} - {$newPostOwnerIpAddress}");
                ResponseCore::redirectTo("/post?owner=" . $getInfo["parent"] . "&page=0");
            }
        }
    }
}
