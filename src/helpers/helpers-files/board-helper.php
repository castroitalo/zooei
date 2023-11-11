<?php 

declare(strict_types=1);

use src\models\BoardModel;

/**
 * Get interests boards
 *
 * @return array|false|string
 */
function get_interests_boards(): array|false|string 
{
    $board_category = "intr";

    return (new BoardModel($_ENV["DB_BOARDS_TBL"]))->getBoards(
        "board_uri, board_title",
        "WHERE board_category=:board_category",
        "board_category={$board_category}",
        null, 
        null
    );
} 

/**
 * Get states boards
 *
 * @return array|false|string
 */
function get_states_boards(): array|false|string 
{
    $board_category = "brl";

    return (new BoardModel($_ENV["DB_BOARDS_TBL"]))->getBoards(
        "board_uri, board_title",
        "WHERE board_category=:board_category",
        "board_category={$board_category}",
        null, 
        null
    );
} 
