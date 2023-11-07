<?php 

declare(strict_types=1);

namespace src\controllers;

use src\core\BaseControllerCore;

/**
 * Class HomeController
 * 
 * @package src\controllers
 */
class HomeController extends BaseControllerCore
{
    /**
     * Renders website homepage
     *
     * @return void
     */
    public function home(): void 
    {
        $this->controllerView->render("home.view");
    }
}
