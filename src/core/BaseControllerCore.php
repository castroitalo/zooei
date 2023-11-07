<?php

declare(strict_types=1);

namespace src\core;

/**
 * Class BaseControllerCore
 * 
 * @package src\core
 * @abstract
 */
class BaseControllerCore
{
    /**
     * Controller view manager
     *
     * @var ViewCore
     */
    protected ViewCore $controllerView;

    /**
     * BaseControllerCore constructor
     */
    public function __construct()
    {
        $this->controllerView = new ViewCore();
    }

    /**
     * Set new flash
     *
     * @param string $flashMessage
     * @param string $flashType
     * @return void
     */
    public function setNewFlash(string $flashMessage, string $flashType): void
    {
        (new SessionCore())->setSessionValue("flash_message", $flashMessage);
        (new SessionCore())->setSessionValue("flash_type", $flashType);
    }
}
