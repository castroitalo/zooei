<?php

declare(strict_types=1);

namespace tests\models;

use Dotenv\Dotenv;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\RequiresPhp;
use PHPUnit\Framework\Attributes\RequiresPhpunit;
use PHPUnit\Framework\TestCase;
use src\models\BoardModel;
use stdClass;

/**
 * Class BoadModelTest
 * 
 * @package tests\models
 */
#[RequiresPhp("8.2.13")]
#[RequiresPhpunit("10.4")]
class BoardModelTest extends TestCase
{
    /**
     * BoardModel instance for testing
     *
     * @param BoardMode
     */
    private BoardModel $boardModel;

    /**
     * BoardModelTest setUp()
     *
     * @return void
     */
    protected function setUp(): void
    {
        $dotenv = Dotenv::createImmutable(CONF_ROOT_DIR);

        $dotenv->load();

        $this->boardModel = new BoardModel($_ENV["TEST_DB_BOARDS_TBL"]);
    }

    /**
     * BoardModel::getBoards teste data provider
     *
     * @return array
     */
    public static function boardModelGetBoardsTestDataProvider(): array
    {
        return [
            "success_default_columns_no_where_no_limit_no_offset" => [
                "*", "", "", null, null, [new stdClass()]
            ],
            "success_custom_columns_no_where_no_limit_no_offset" => [
                "test_board_id", "", "", null, null, [new stdClass()]
            ],
            "success_default_columns_where_no_limit_no_offset" => [
                "*", 
                "WHERE test_board_id=:test_board_id", 
                "test_board_id=1", 
                null, 
                null, 
                [new stdClass()]
            ],
            "success_default_columns_no_where_limit_no_offset" => [
                "*", "", "", 10, null, [new stdClass()]
            ],
            "success_default_columns_no_where_limit_offset" => [
                "*", "", "", 10, 10, [new stdClass()]
            ],
            "success_custom_columns_where_no_limit_no_offset" => [
                "test_board_id", "", "", null, null, [new stdClass()]
            ],
            "success_custom_columns_no_where_limit_no_offset" => [
                "test_board_id", "", "", 10, null, [new stdClass()]
            ],
            "success_custom_columns_no_where_limit_offset" => [
                "test_board_id", "", "", 10, 10, [new stdClass()]
            ],
            "success_default_columns_where_no_limit_no_offset" => [
                "*",
                "WHERE test_board_id=:test_board_id", 
                "test_board_id=1", 
                null, 
                null,  
                [new stdClass()]
            ],
            "success_default_columns_where_limit_no_offset" => [
                "*",
                "WHERE test_board_id=:test_board_id", 
                "test_board_id=1", 
                10, 
                null,  
                [new stdClass()]
            ],
            "success_default_columns_where_limit_offset" => [
                "*",
                "WHERE test_board_id=:test_board_id", 
                "test_board_id=1", 
                10, 
                10,  
                [new stdClass()]
            ],
            "success_no_data" => [
                "*",
                "WHERE test_board_id=:test_board_id", 
                "test_board_id=999", 
                null, 
                null,  
                []
            ],
            "failed" => [
                "failed", "", "", null, null,  "Falha ao carregar interesses. Tente novamente mais tarde"
            ]
        ];
    }

    /**
     * Test BoardModel::getBoards
     * 
     * @param string $columns
     * @param string $where
     * @param string $whereParams
     * @param ?int $limit
     * @param ?int $offset
     * @param array|false|string $expect
     * @return void
     */
    #[DataProvider("boardModelGetBoardsTestDataProvider")]
    public function testBoardModelGetBoards(
        string $columns,
        string $where,
        string $whereParams,
        ?int $limit,
        ?int $offset,
        array|false|string $expect
    ): void {
        $actual = $this->boardModel->getBoards(
            $columns,
            $where,
            $whereParams,
            $limit,
            $offset
        );

        // Success with data
        if (is_array($expect)) {
            $this->assertIsArray($actual);

        // Success with no data
        } else if ($expect === false) {
            $this->assertFalse($actual);

        // Failed
        } else {
            $this->assertIsString($actual);
            $this->assertEquals(
                "Falha ao carregar interesses. Tente novamente mais tarde",
                $actual
            );
        }
    }
}
