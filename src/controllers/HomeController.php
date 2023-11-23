<?php

declare(strict_types=1);

namespace src\controllers;

use src\core\BaseControllerCore;
use src\core\RequestCore;
use src\core\ResponseCore;

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
        $requestBody = RequestCore::getGetRequestBody();

        if (!empty($requestBody)) {

            // See if user acknowledged the disclaimer
            if ((bool)$requestBody["accept"] === true) {
                set_session_key("dack", "yes");
                ResponseCore::redirectTo("/");
            }
        }

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

    /**
     * Render support page
     *
     * @return void
     */
    public function supportPage(): void
    {
        $pixKey = $_ENV["SUP_PIX_KEY"];

        $this->controllerView->render("support.view", ["pix_key" => $pixKey]);
    }

    /**
     * Render 404 page not found
     *
     * @return void
     */
    public function notFoundPage(): void
    {
        $this->controllerView->render("not-found.view");
    }
}
