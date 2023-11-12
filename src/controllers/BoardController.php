<?php

declare(strict_types=1);

namespace src\controllers;

use src\core\BaseControllerCore;
use src\core\RequestCore;
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
        $requestedBoard = (new BoardModel())
            ->getBoardByUri(RequestCore::getRequestUri());

        $this->controllerView->render(
            "board.view",
            ["boardTitle" => $requestedBoard->board_title]
        );
    }
}
