<?php

declare(strict_types=1);

namespace src\models;

/**
 * Class RouteModel
 * 
 * @package src\models
 */
class RouteModel
{
    /**
     * HTTP methods avaliable to use
     *
     * @var array
     */
    private array $avaliableHttpMethods = [
        "GET", "POST", "PUT", "DELETE", "PATCH"
    ];

    /**
     * Route HTTP method
     *
     * @var string
     */
    private string $routeHttpMethod = "";

    /**
     * Route URI
     *
     * @var string
     */
    private string $routeUri;

    /**
     * Route controller callback with class and method to be executed
     *
     * @var array
     */
    private array $routeControllerCallback;

    /**
     * Route middleware callback with class and method to be executed
     *
     * @var array|null
     */
    private ?array $routeMiddlewareCallback;

    /**
     * RouteModel::__construct
     *
     * @param string $routeHttpMethod
     * @param string $routeUri
     * @param array $routeControllerCallback
     * @param array|null $routeMiddlewareCallback
     */
    public function __construct(
        string $routeHttpMethod,
        string $routeUri,
        array $routeControllerCallback,
        ?array $routeMiddlewareCallback = null
    ) {
        if (in_array($routeHttpMethod, $this->avaliableHttpMethods)) {
            $this->routeHttpMethod = $routeHttpMethod;
        }

        $this->routeUri = $routeUri;
        $this->routeControllerCallback = $routeControllerCallback;
        $this->routeMiddlewareCallback = $routeMiddlewareCallback;
    }

    /**
     * Route::$routeHttpMethod getter
     *
     * @return string
     */
    public function getRouteHttpMethod(): string 
    {
        return $this->routeHttpMethod;
    }

    /**
     * Route::$routeUri getter
     *
     * @return string
     */
    public function getRouteUri(): string 
    {
        return $this->routeUri;
    }

    /**
     * Router::$routeControllerCallback getter
     *
     * @return array
     */
    public function getRouteControllerCallback(): array 
    {
        return $this->routeControllerCallback;
    }

    /**
     * Router::$routeMiddlewareCallback getter
     *
     * @return array|null
     */
    public function getRouteMiddlewareCallback(): ?array
    {
        return $this->routeMiddlewareCallback;
    }
}
