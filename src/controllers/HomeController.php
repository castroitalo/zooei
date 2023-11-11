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
        $requestBody = RequestCore::getRequestBody();

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
        $this->controllerView->render("support.view");
    }

    /**
     * Render advertise page
     *
     * @return void
     */
    public function advertisePage(): void 
    {
        $this->controllerView->render("advertise.view");
    }
}
