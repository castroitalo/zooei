<?php

declare(strict_types=1);

namespace tests\core;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\RequiresPhp;
use PHPUnit\Framework\Attributes\RequiresPhpunit;
use PHPUnit\Framework\TestCase;
use src\core\RouterCore;
use stdClass;

/**
 * Class RouterCoreTest
 * 
 * @package src\core
 */
#[RequiresPhp("8.2.12")]
#[RequiresPhpunit("10.4")]
class RouterCoreTest extends TestCase
{
    /**
     * RouterCore instance for testing
     *
     * @var RouterCore
     */
    private RouterCore $router;

    /**
     * RouterCoreTest::setUp
     *
     * @return void
     */
    protected function setUp(): void
    {
        $this->router = new RouterCore();
    }

    public static function routerCoreNewRouterTestDataProvider(): array
    {
        return [
            "get_without_middleware" => [
                "GET",
                "/",
                [stdClass::class, "controllerMethod"],
                null
            ],
            "get_with_middleware" => [
                "GET",
                "/",
                [stdClass::class, "controllerMethod"],
                [stdClass::class, "middlewareMethod"],
            ],
            "post_without_middleware" => [
                "POST",
                "/",
                [stdClass::class, "controllerMethod"],
                null
            ],
            "post_with_middleware" => [
                "POST",
                "/",
                [stdClass::class, "controllerMethod"],
                [stdClass::class, "middlewareMethod"],
            ],
            "put_without_middleware" => [
                "PUT",
                "/",
                [stdClass::class, "controllerMethod"],
                null
            ],
            "put_with_middleware" => [
                "PUT",
                "/",
                [stdClass::class, "controllerMethod"],
                [stdClass::class, "middlewareMethod"],
            ],
            "delete_without_middleware" => [
                "DELETE",
                "/",
                [stdClass::class, "controllerMethod"],
                null
            ],
            "delete_with_middleware" => [
                "DELETE",
                "/",
                [stdClass::class, "controllerMethod"],
                [stdClass::class, "middlewareMethod"],
            ],
            "patch_without_middleware" => [
                "PATCH",
                "/",
                [stdClass::class, "controllerMethod"],
                null
            ],
            "dpatch_with_middleware" => [
                "PATCH",
                "/",
                [stdClass::class, "controllerMethod"],
                [stdClass::class, "middlewareMethod"],
            ]
        ];
    }

    #[DataProvider("routerCoreNewRouterTestDataProvider")]
    public function testRouterCoreNewRouter(
        string $routeHttpMethod,
        string $routeUri,
        array $routeControllerCallback,
        ?array $routeMiddlewareCallback
    ): void {
        // Add a new route
        if ($routeHttpMethod === "GET") {
            $this->router->get(
                $routeUri,
                $routeControllerCallback,
                $routeMiddlewareCallback
            );
        } else if ($routeHttpMethod === "POST") {
            $this->router->post(
                $routeUri,
                $routeControllerCallback,
                $routeMiddlewareCallback
            );
        } else if ($routeHttpMethod === "PUT") {
            $this->router->put(
                $routeUri,
                $routeControllerCallback,
                $routeMiddlewareCallback
            );
        } else if ($routeHttpMethod === "DELETE") {
            $this->router->delete(
                $routeUri,
                $routeControllerCallback,
                $routeMiddlewareCallback
            );
        } else if ($routeHttpMethod === "PATCH") {
            $this->router->patch(
                $routeUri,
                $routeControllerCallback,
                $routeMiddlewareCallback
            );
        }

        $route = $this->router->getRoutes()[$routeHttpMethod][$routeUri];

        // Assert if the route was created correctly
        $this->assertFalse(empty($this->router->getRoutes()[$routeHttpMethod]));
        $this->assertIsArray($route->getRouteControllerCallback());

        // Assert middleware
        if (is_null($route->getRouteMiddlewareCallback())) {
            $this->assertNull($route->getRouteMiddlewareCallback());
        } else {
            $this->assertIsArray($route->getRouteMiddlewareCallback());
        }
    }
}
