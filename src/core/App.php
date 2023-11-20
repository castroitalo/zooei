<?php 

declare(strict_types=1);

namespace src\core;

/**
 * Class App 
 * 
 * @package src\core
 */
class App 
{
    /**
     * App's router
     *
     * @var RouterCore
     */
    public RouterCore $router;

    /**
     * App's session
     *
     * @var SessionCore
     */
    public SessionCore $session;

    /**
     * App constructor
     */
    public function __construct()
    {
        $this->router = new RouterCore();
        $this->session = new SessionCore();
    }
}
