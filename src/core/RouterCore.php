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
     * Match requested route with defined route
     *
     * @param string $requestHttpMethod
     * @param string $requestUri
     * @return RouteModel|null
     */
    public function matchRoute(string $requestHttpMethod, string $requestUri): RouteModel|null 
    {
        foreach ($this->routes[$requestHttpMethod] as $route) {
            if ($route->getRouteUri() === $requestUri) {
                return $route;
            }
        }

        return null;
    }

    /**
     * Execute route middleware if it has one
     *
     * @param RouteModel $route
     * @return void
     */
    public function executeRouteMiddlewareCallback(RouteModel $route): void 
    {
        $middlewareClass = $route->getRouteMiddlewareCallback()[0];
        $middlewareMethod = $route->getRouteMiddlewareCallback()[1];
        $middlewareClass = new $middlewareClass();

        call_user_func([$middlewareClass, $middlewareMethod]);
    }

    /**
     * Execute route controller callback
     *
     * @param RouteModel $route
     * @return void
     */
    public function executeRouteControllerCallback(RouteModel $route): void 
    {
        $controllerClass = $route->getRouteControllerCallback()[0];
        $controllerMethod = $route->getRouteControllerCallback()[1];
        $controllerClass = new $controllerClass();

        call_user_func([$controllerClass, $controllerMethod]);
    }

    /**
     * Handle request route
     *
     * @return void
     */
    public function handleRequest(): void 
    {
        $requestHttpMethod = RequestCore::getRequestHttpMethod();
        $requestUri = RequestCore::getRequestUri();
        $route = $this->matchRoute($requestHttpMethod, $requestUri);
    
        // If the request URI doesn't exists
        if ($route === null) {
            ResponseCore::setResponseStatusCode(404);
            ResponseCore::redirectTo("/pagenotfound");
        }

        // Execute route middleware
        if (!is_null($route->getRouteMiddlewareCallback())) {
            $this->executeRouteMiddlewareCallback($route);
        }

        // Execute route controller
        $this->executeRouteControllerCallback($route);
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
