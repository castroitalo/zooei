<?php

/**
 * > Created at: 06/11/2023
 */

declare(strict_types=1);

use src\controllers\HomeController;
use src\core\App;

require_once __DIR__ . "/bootstrap.php";

$app = new App();

$app->router->get("/", [HomeController::class, "homepage"]);
$app->router->get("/rules", [HomeController::class, "rulesPage"]);
$app->router->get("/support", [HomeController::class, "supportPage"]);

$app->router->handleRequest();
