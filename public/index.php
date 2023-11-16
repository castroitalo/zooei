<?php

/**
 * > Created at: 06/11/2023
 */

declare(strict_types=1);

use src\controllers\BoardController;
use src\controllers\HomeController;
use src\controllers\PostController;
use src\core\App;

require_once __DIR__ . "/bootstrap.php";

$app = new App();

// Home routes
$app->router->get("/", [HomeController::class, "homepage"]);
$app->router->get("/rules", [HomeController::class, "rulesPage"]);
$app->router->get("/support", [HomeController::class, "supportPage"]);
$app->router->get("/advertise", [HomeController::class, "advertisePage"]);

// Boards routes
foreach (get_all_boards_uri() as $board) {
    $app->router->get($board->board_uri, [BoardController::class, "boardPage"]);
}

// Posts routes
$app->router->post("/newpost", [PostController::class, "createNewPost"]);
$app->router->get("/post", [PostController::class, "postPage"]);
$app->router->post("/newcomment", [PostController::class, "createNewComment"]);

// Not found
$app->router->get("/pagenotfound", [HomeController::class, "notFoundPage"]);

$app->router->handleRequest();
