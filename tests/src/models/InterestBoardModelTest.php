<?php

declare(strict_types=1);

namespace tests\models;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\RequiresPhp;
use PHPUnit\Framework\Attributes\RequiresPhpunit;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use src\core\DaoCore;
use src\models\InterestBoardModel;
use stdClass;

#[RequiresPhp("8.2.12")]
#[RequiresPhpunit("10.4")]
class InterestBoardModelTest extends TestCase
{
    /**
     * DaoCore mock object
     *
     * @var DaoCore|MockObject
     */
    private DaoCore|MockObject $daoCoreMock;

    /**
     * InterestBoardModel instance for testing
     *
     * @var InterestBoardModel
     */
    private InterestBoardModel $interestBoard;

    /**
     * InterestBoardModel::setUp function
     *
     * @return void
     */
    protected function setUp(): void
    {
        $this->daoCoreMock = $this->createMock(DaoCore::class);
        $this->interestBoard = new InterestBoardModel($this->daoCoreMock);
    }

    /**
     * InterestBoardModel::getInterestsBoardCategories() data provider
     *
     * @return array
     */
    public static function getInterestBoardCategoriesDataProvider(): array
    {
        return [
            "success_default_limit_default_offset_default_columns" => [
                null, null, "*", [new stdClass()]
            ],
            "success_custom_limit_default_offset_default_columns" => [
                5, null, "*", [new stdClass()]
            ],
            "success_custom_limit_custom_offset_default_columns" => [
                5, 10, "*", [new stdClass()]
            ],
            "success_custom_limit_custom_offset_custom_columns" => [
                5, 10, "board_interests_title", [new stdClass()]
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
     * Test InterestBoardModel::getInterestsBoardCategories()
     *
     * @param integer|null $limit
     * @param integer|null $offset
     * @param string $columns
     * @param array|false|string $expect
     * @return void
     */
    #[DataProvider("getInterestBoardCategoriesDataProvider")]
    public function testGetInterestBoardCategories(
        ?int $limit,
        ?int $offset,
        string $columns,
        array|false|string $expect
    ): void {
        $this->daoCoreMock->expects($this->once())
            ->method("getData")
            ->with($limit, $offset, $columns)
            ->willReturn($expect);

        $actual = $this->interestBoard->getInterestsBoardCategories(
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
