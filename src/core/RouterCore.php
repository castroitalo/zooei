<?php

declare(strict_types=1);

namespace src\core;

use src\models\RouteModel;

/**
 * Class RouterCore
 * 
 * @package src\core
 */
class RouterCore
{
    /**
     * Created routes
     *
     * @var array
     */
    public array $routes = [];

    /**
     * Create a new route with GET HTTP method
     *
     * @param string $routeUri
     * @param array $routeControllerCallback
     * @param array|null $routeMiddlewareCallback
     * @return void
     */
    public function get(
        string $routeUri,
        array $routeControllerCallback,
        ?array $routeMiddlewareCallback = null
    ): void {
        $this->routes["GET"][$routeUri] = new RouteModel(
            "GET",
            $routeUri,
            $routeControllerCallback,
            $routeMiddlewareCallback
        );
    }

    /**
     * Create a new route with POST HTTP method
     *
     * @param string $routeUri
     * @param array $routeControllerCallback
     * @param array|null $routeMiddlewareCallback
     * @return void
     */
    public function post(
        string $routeUri,
        array $routeControllerCallback,
        ?array $routeMiddlewareCallback = null
    ): void {
        $this->routes["POST"][$routeUri] = new RouteModel(
            "POST",
            $routeUri,
            $routeControllerCallback,
            $routeMiddlewareCallback
        );
    }

    /**
     * Create a new route with PUT HTTP method
     *
     * @param string $routeUri
     * @param array $routeControllerCallback
     * @param array|null $routeMiddlewareCallback
     * @return void
     */
    public function put(
        string $routeUri,
        array $routeControllerCallback,
        ?array $routeMiddlewareCallback = null
    ): void {
        $this->routes["PUT"][$routeUri] = new RouteModel(
            "PUT",
            $routeUri,
            $routeControllerCallback,
            $routeMiddlewareCallback
        );
    }

    /**
     * Create a new route with DELETE HTTP method
     *
     * @param string $routeUri
     * @param array $routeControllerCallback
     * @param array|null $routeMiddlewareCallback
     * @return void
     */
    public function delete(
        string $routeUri,
        array $routeControllerCallback,
        ?array $routeMiddlewareCallback = null
    ): void {
        $this->routes["DELETE"][$routeUri] = new RouteModel(
            "DELETE",
            $routeUri,
            $routeControllerCallback,
            $routeMiddlewareCallback
        );
    }

    /**
     * Create a new route with PATCH HTTP method
     *
     * @param string $routeUri
     * @param array $routeControllerCallback
     * @param array|null $routeMiddlewareCallback
     * @return void
     */
    public function patch(
        string $routeUri,
        array $routeControllerCallback,
        ?array $routeMiddlewareCallback = null
    ): void {
        $this->routes["PATCH"][$routeUri] = new RouteModel(
            "PATCH",
            $routeUri,
            $routeControllerCallback,
            $routeMiddlewareCallback
        );
    }

    /**
     * Get all created routes
     *
     * @return array
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }
}
