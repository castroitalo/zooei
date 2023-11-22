<?php 

declare(strict_types=1);

use src\core\SessionCore;

/**
 * Generate post owner ID
 *
 * @return string
 */
function generate_owner(): string 
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
function generate_image_filename(array $uploadImageInfo, string $owner): string 
{
    $postNameArray = explode(".", $uploadImageInfo["name"]);
    $postNameArray[0] = $owner . "_image";

    return implode(".", $postNameArray);
}

function anonymize_client_ip_address(string $clientIpAddess): string 
{
    $octets = explode(".", $clientIpAddess);

    array_pop($octets);

    $octets[] = "O";

    return hash("sha256", implode(".", $octets));
}
