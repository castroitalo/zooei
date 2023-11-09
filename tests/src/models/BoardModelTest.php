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

        // For this test was used interest table
        $this->boardModel = new BoardModel(
            $_ENV["DB_BOARD_INTERESTS"],
            $this->daoCoreMock
        );
    }

    /**
     * BoardModel::getBoardCategories() data provider
     *
     * @return array
     */
    public static function getBoardCategoriesDataProvider(): array
    {
        return [
            "success_default_limit_default_offset_default_columns" => [
                null, null, "*", [new stdClass()]
            ],
            "success_custom_limit_default_offset_default_columns" => [
                4, null, "*", [new stdClass()]
            ],
            "success_custom_limit_custom_offset_default_columns" => [
                4, 10, "*", [new stdClass()]
            ],
            "success_custom_limit_custom_offset_custom_columns" => [
                4, 10, "board_interests_title", [new stdClass()]
            ],
            "success_with_no_data" => [
                null, null, "*", false
            ],
            "failed_exception" => [
                null, null, "*", "Failed to get data. Try again later."
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
    #[DataProvider("getBoardCategoriesDataProvider")]
    public function testGetBoardCategories(
        ?int $limit,
        ?int $offset,
        string $columns,
        array|false|string $expect
    ): void {
        $this->daoCoreMock->expects($this->once())
            ->method("getData")
            ->with($limit, $offset, $columns)
            ->willReturn($expect);

        $actual = $this->boardModel->getBoardCategories(
            $limit,
            $offset,
            $columns
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
