<?php

declare(strict_types=1);

namespace src\controllers;

use src\core\BaseControllerCore;
use src\core\RequestCore;
use src\models\BoardModel;
use src\models\PostModel;

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
        $boardPage = RequestCore::getGetRequestBody();
        $boardPostsLimit = (int)$boardPage["page"] * 10;
        $boardPosts = (new PostModel())
            ->getAllBoardPosts($requestedBoard->board_id, $boardPostsLimit);

        $this->controllerView->render(
            "board.view",
            [
                "board_title" => $requestedBoard->board_title,
                "board_uri" => ltrim($requestedBoard->board_uri, "/"),
                "board_posts" => $boardPosts,
                "board_page" => (int)$boardPage["page"]
            ]
        );
    }
}
