<?php 

declare(strict_types=1);

use src\core\App;

require_once __DIR__ . "/bootstrap.php";

$app = new App();

$app->router->get("/", [stdClass::class, "method"]);

echo "<pre>";
var_dump($app->router->getRoutes()["GET"]["/"]->getRouteMiddlewareCallback());
echo "<pre>";

