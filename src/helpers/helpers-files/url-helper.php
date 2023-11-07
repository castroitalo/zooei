<?php 

declare(strict_types=1);

/**
 * Get project URL address
 *
 * @return string
 */
function get_url(string $urlPath = ""): string 
{
    return CONF_DEV_URL . $urlPath;
}
