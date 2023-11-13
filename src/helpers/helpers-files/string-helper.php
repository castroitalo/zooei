<?php 

declare(strict_types=1);

/**
 * Format text if it is bigger that the specifies limit
 *
 * @param string $text
 * @param integer $limit
 * @return string
 */
function limit_words(string $text, int $limit, string $replace = "..."): string 
{
    $textArray = explode(" ", $text);

    if (count($textArray) >= $limit) {
        $textArray[$limit - 1] = $replace;
        $newText = implode(" ", array_slice($textArray, 0, $limit));

        return $newText;
    }

    return $text;
}
