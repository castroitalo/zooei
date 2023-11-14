<?php 

declare(strict_types=1);

use src\core\FlashCore;
use src\core\SessionCore;

/**
 * Get a flash to me displayed 
 *
 * @return string
 */
function get_flash_message(): string 
{
    $session = new SessionCore();
    $flash_message = $session->getSessionValue("flash_message");
    $flash_type = $session->getSessionValue("flash_type");

    $session->unsetSessionValue("flash_message");
    $session->unsetSessionValue("flash_type");

    return (new FlashCore($flash_message, $flash_type))->getFlash();
}
