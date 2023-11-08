<?php

/**
 * O maior imageboard brasileiro. Nossa missão é libertar as pessoas da régua moral das big techs.
 * 
 * Created at: 06/11/2023
 * 
 *⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀ ⣀⣴⣾⣷⣦⣀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
 *⠀⠀⠀⠀⠀⠀⠀ ⢀⣴⣾⡿⠿⠟⠻⠿⢿⣷⣦⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀
 *⠀⠀⠀⠀ ⣀⣤⣾⣿⠟⠁⠀⠀⠀⠀⠀⠀⠈⠻⣿⣷⣤⣀⠀⠀⠀⠀⠀⠀
 *   ⣀⣴⣾⣿⣿⣿⡿⠿⠿⠿⠶⢶⣦⣤⣀⠀⠀⢹⣿⣿⣿⣷⣦⣀⠀⠀⠀
 * ⠰⢾⣿⣿⣿⣿⣿⣿⡁⠀⠀⠀⠀⠀⠀⠈⠙⠳⣦⣈⣿⣿⣿⣿⣿⣿⡷⠆⠀
 *    ⠉⠻⢿⣿⣿⣿⣇⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣹⣿⣿⣿⡿⠟⠉⠀⠀⠀
 *        ⠉⠛⢿⣿⣦⡀⠀⠀⠀⠀⠀⠀⢀⣴⣿⡿⠛⠉⠀⠀⠀⠀⠀⠀
 *            ⠈⠻⢿⣷⣶⣦⣴⣶⣾⡿⠟⠁⠀⠀⠀⠀⠀⠀⠀⠀⠀
 *                ⠉⠻⢿⡿⠟⠉⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
 */


declare(strict_types=1);

use src\controllers\HomeController;
use src\core\App;

require_once __DIR__ . "/bootstrap.php";

$app = new App();

$app->router->get(
    "/",
    [HomeController::class, "home"]
);

$app->router->handleRequest();
