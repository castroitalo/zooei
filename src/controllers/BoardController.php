<?php

declare(strict_types=1);

namespace src\controllers;

use src\core\BaseControllerCore;
use src\core\RequestCore;
use src\core\ResponseCore;
use src\models\BoardModel;

/**
 * Class BoardController
 * 
 * @package src\controllers
 */
class BoardController extends BaseControllerCore
{
    /**
     * Render board page
     *
     * @return void
     */
    public function boardPage(): void
    {
        // Get requested board
        $requestedBoard = (new BoardModel())
            ->getBoardByUri(RequestCore::getRequestUri());

        $this->controllerView->render(
            "board.view",
            [
                "board_title" => $requestedBoard->board_title,
                "board_uri" => ltrim($requestedBoard->board_uri, "/")
            ]
        );
    }

    public function createNewPost(): void
    {
        $boardUri = RequestCore::getGetRequestBody();
        $imageUploadInfo = RequestCore::getUploadBody();
        $postText = RequestCore::getPostRequestBody();

        if (empty($imageUploadInfo) || empty($postText)) {
            ResponseCore::setResponseStatusCode(404);
            ResponseCore::redirectTo("/pagenotfound");
        }

        if (!empty($boardUri)) {
            $boardObject = (new BoardModel())
                ->getBoardByUri("/" . $boardUri["board"]);

            if (is_object($boardObject)) {
                $postBoardId = $boardObject->board_id;
                $postOwner = generate_post_owner();
                $postImage = generate_image_filename($imageUploadInfo["post_image"], $postOwner);
                $postText = $postText["post_text"];
            }
        } else {
            ResponseCore::setResponseStatusCode(404);
            ResponseCore::redirectTo("/pagenotfound");
        }
    }
}
