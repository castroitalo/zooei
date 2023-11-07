<?php

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
