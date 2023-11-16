<?php 

declare(strict_types=1);

use src\core\SessionCore;

/**
 * Generate post owner ID
 *
 * @return string
 */
function generate_post_owner(): string 
{
    return hash("sha256", date("dmis") . (new SessionCore())->getSessionId());
}

/**
 * Generate a new filename based on post owner ID
 *
 * @param array $uploadImageInfo
 * @param string $postOwner
 * @return string
 */
function generate_image_filename(array $uploadImageInfo, string $postOwner): string 
{
    $postNameArray = explode(".", $uploadImageInfo["name"]);
    $postNameArray[0] = $postOwner . "_image";

    return implode(".", $postNameArray);
}
