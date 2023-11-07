<?php 

declare(strict_types=1);

namespace src\controllers;

/**
 * Class HomeController
 * 
 * @package src\controllers
 */
class HomeController
{
    public function home(): void 
    {
        echo "ola home";
    }

    public function homeMiddleware(): void 
    {
        echo "middleware home";
    }
}
