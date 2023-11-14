<?php

declare(strict_types=1);

namespace src\controllers;

use src\core\BaseControllerCore;
use src\core\RequestCore;
use src\core\ResponseCore;
use src\models\BoardModel;

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
            $uploadImageInfo === [] || 
            $postText === []
        ) {
            return false;
        }

        $boardObject = (new BoardModel())
            ->getBoardByUri("/" . $boardUri["board"]);

        if (is_object($boardObject)) {
            $postBoardId = $boardObject->board_id;
            $postOwner = generate_post_owner();
            $postImagePath = generate_image_filename(
                $uploadImageInfo["post_image"],
                $postOwner
            );
            $postText = $postText["post_text"];

            return [
                "post_board_id" => $postBoardId,
                "post_owner" => $postOwner,
                "post_image" => $postImagePath,
                "post_text" => $postText
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

        echo "<pre>";
        var_dump($newPostData);
        echo "</pre>";
    }
}
