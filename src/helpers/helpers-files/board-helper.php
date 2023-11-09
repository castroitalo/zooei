<?php 

declare(strict_types=1);

use src\models\BoardModel;

/**
 * Get interest board categories
 *
 * @return array|false|string
 */
function get_interest_board_categories(): array|false|string 
{
    return (new BoardModel($_ENV["DB_BOARD_INTERESTS"]))->getBoardCategories();
} 

/**
 * Get states board categories
 *
 * @return array|false|string
 */
function get_states_board_categories(): array|false|string 
{
    return (new BoardModel($_ENV["DB_BOARD_STATES"]))->getBoardCategories();
} 

