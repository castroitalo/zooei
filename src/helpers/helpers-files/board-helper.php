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

    return (new BoardModel())->getBoards(
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

    return (new BoardModel())->getBoards(
        "board_uri, board_title",
        "WHERE board_category=:board_category",
        "board_category={$board_category}",
        null, 
        null
    );
} 

/**
 * Get all zooei's boards uri
 *
 * @return array|false|string
 */
function get_all_boards_uri(): array|false|string
{
    return (new BoardModel())->getBoards("board_uri", "", "", null, null);
}
