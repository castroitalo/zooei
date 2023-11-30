<?php

declare(strict_types=1);

namespace src\controllers;

use src\core\BaseControllerCore;
use src\core\RequestCore;

/**
 * Class BoardController
 * 
 * @package src\controllers
 */
class BoardController 
{
    // Base trait
    use BaseControllerCore;

    /**
     * Render board page
     *
     * @return void
     */
    public function boardPage(): void
    {
        // Get requested board
        $requestedBoard = $this->app->boardModel->getBoardByUri(RequestCore::getRequestUri());
        $boardPage = RequestCore::getGetRequestBody();
        $boardPostsLimit = (int)$boardPage["page"] * 10;
        $boardPosts = $this->app->postModel->getAllBoardPosts($requestedBoard->board_id, $boardPostsLimit);

        $this->app->viewCore->render(
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
