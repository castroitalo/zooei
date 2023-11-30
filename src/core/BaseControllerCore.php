<?php 

declare(strict_types=1);

namespace src\core;

/**
 * Trait BaseController
 * 
 * @package src\core
 */
trait BaseControllerCore
{
    /**
     * App instance
     *
     * @var App
     */
    public App $app;

    /**
     * BaseController
     */
    public function __construct()
    {
        $this->app = new App();
    }

    /**
     * Set new flash message
     *
     * @param string $flashMessage
     * @param string $flashType
     * @return void
     */
    public function setNewFlash(string $flashMessage, string $flashType): void 
    {
        $this->app->sessionCore->setSessionValue("flash_message", $flashMessage);
        $this->app->sessionCore->setSessionValue("flash_type", $flashType);
    }
}
