<?php 

declare(strict_types=1);

use src\core\RequestCore;

/**
 * Get project URL address
 *
 * @return string
 */
function get_url(string $urlPath = ""): string 
{
    return CONF_DEV_URL . $urlPath;
}

function get_uri(): string 
{
    return RequestCore::getRequestUri();
}
