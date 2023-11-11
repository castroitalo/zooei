<?php

declare(strict_types=1);

namespace tests\models;

use Dotenv\Dotenv;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\RequiresPhp;
use PHPUnit\Framework\Attributes\RequiresPhpunit;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use src\core\DaoCore;
use src\models\BoardModel;
use stdClass;

/**
 * Class BoadModelTest
 * 
 * @package tests\models
 */
#[RequiresPhp("8.2.12")]
#[RequiresPhpunit("10.4")]
class BoardModelTest extends TestCase
{
    /**
     * DaoCore mock object
     *
     * @var DaoCore|MockObject
     */
    private DaoCore|MockObject $daoCoreMock;

    /**
     * BoardModel instance for testing
     *
     * @var BoardModel
     */
    private BoardModel $boardModel;

    /**
     * BoardModelTest::setUp function
     *
     * @return void
     */
    protected function setUp(): void
    {
        $dotenv = Dotenv::createImmutable(CONF_ROOT_DIR);

        $dotenv->load();

        $this->daoCoreMock = $this->createMock(DaoCore::class);
        $this->boardModel = new BoardModel($this->daoCoreMock);
    }

    /**
     * BoardModel::getBoardCategories() data provider
     *
     * @return array
     */
    public static function getBoardsDataProvider(): array
    {
        return [
            "success_default_limit_default_offset_default_columns_no_where" => [
                "*", "", "", null, null, [new stdClass()]
            ],
            "success_default_limit_default_offset_default_columns_with_where" => [
                "*", "WHERE column=:column", "columns=coluna", null, null, [new stdClass()]
            ],
            "success_custom_limit_default_offset_default_columns_no_where" => [
                "*", "WHERE column=:column", "columns=coluna", 10, null, [new stdClass()]
            ],
            "success_custom_limit_custom_offset_default_columns_no_where" => [
                "*", "WHERE column=:column", "columns=coluna", 5, 10, [new stdClass()]
            ],
            "success_custom_limit_custom_offset_custom_columns_no_where" => [
                "coluna_um", "WHERE column=:column", "columns=coluna", 5, 10, [new stdClass()]
            ],
            "success_no_data" => [
                "*", "", "", null, null, false
            ],
            "failed" => [
                "*", "", "", null, null, "Failed to get data. Try again later."
            ]
        ];
    }

    /**
     * Test BoardModel::getBoardCategories()
     *
     * @param integer|null $limit
     * @param integer|null $offset
     * @param string $columns
     * @param array|false|string $expect
     * @return void
     */
    #[DataProvider("getBoardsDataProvider")]
    public function testGetBoards(
        string $columns,
        string $where,
        string $whereParams,
        ?int $limit,
        ?int $offset,
        array|false|string $expect
    ): void {
        $this->daoCoreMock->expects($this->once())
            ->method("getData")
            ->with($columns, $where, $whereParams, $limit, $offset)
            ->willReturn($expect);

        $actual = $this->boardModel->getBoards(
            $columns,
            $where,
            $whereParams,
            $limit,
            $offset
        );

        // Successfull execution with data
        if (is_array($expect)) {
            $this->assertIsArray($actual);

            // Successfull execution with no data
        } else if ($expect === false) {
            $this->assertFalse($actual);

            // Failed execution with a error message
        } else if (is_string($expect)) {
            $this->assertIsString($actual);
            $this->assertEquals($expect, $actual);
        }
    }
}
