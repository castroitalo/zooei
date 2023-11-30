<?php 

declare(strict_types=1);

namespace src\core;

use src\models\BoardModel;
use src\models\PostModel;

/**
 * Class App 
 * 
 * @package src\core
 */
class App 
{
    /**
     * App's router
     *
     * @var RouterCore
     */
    public RouterCore $router;

    /**
     * App's session
     *
     * @var SessionCore
     */
    public SessionCore $sessionCore;

    /**
     * BoardModel instance
     *
     * @var BoardModel
     */
    public BoardModel $boardModel;

    /**
     * PostModel instance
     *
     * @var PostModel
     */
    public PostModel $postModel;

    /**
     * ViewCore instance
     *
     * @var ViewCore
     */
    public ViewCore $viewCore;

    /**
     * App constructor
     */
    public function __construct()
    {
        $this->router = new RouterCore();
        $this->sessionCore = new SessionCore();
        $this->boardModel = new BoardModel();
        $this->postModel = new PostModel();
        $this->viewCore = new ViewCore();
    }
}
