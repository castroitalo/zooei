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
    public function homepage(): void 
    {
        $this->controllerView->render("home.view");
    }

    /**
     * Render the rules page
     *
     * @return void
     */
    public function rulesPage(): void 
    {
        $this->controllerView->render("rules.view");
    }
}
