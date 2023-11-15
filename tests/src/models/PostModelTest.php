<?php

declare(strict_types=1);

namespace tests\models;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\RequiresPhp;
use PHPUnit\Framework\Attributes\RequiresPhpunit;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use src\core\DaoCore;
use src\models\PostModel;

/**
 * Class PostModelTest
 * 
 * @package tests\models
 */
#[RequiresPhp("8.2.12")]
#[RequiresPhpunit("10.4")]
class PostModelTest extends TestCase
{
    /**
     * DaoCore mock object
     *
     * @var DaoCore|MockObject
     */
    private DaoCore|MockObject $daoCoreMock;

    /**
     * PostModel instance for testing
     *
     * @var PostModel
     */
    private PostModel $postModel;

    /**
     * PostModelTest::setUp
     *
     * @return void
     */
    protected function setUp(): void
    {
        $this->daoCoreMock = $this->createMock(DaoCore::class);
        $this->postModel = new PostModel($this->daoCoreMock);
    }

    /**
     * PostModel::createNewPost test data provider
     *
     * @return array
     */
    public static function createNewPostTestDataProvider(): array
    {
        return [
            "success" => [
                [
                    "post_board_id" => 1,
                    "post_owner" => "6c1af77e6fc94019dee57a61ef20a879abc0f6cbcb4b58ab3e62ba8bafb2f785",
                    "post_image" => "6c1af77e6fc94019dee57a61ef20a879abc0f6cbcb4b58ab3e62ba8bafb2f785_image.png",
                    "post_text" => "Post text."
                ],
                1
            ],
            "failed" => [
                [
                    "post_board_id" => 1,
                    "post_owner" => "6c1af77e6fc94019dee57a61ef20a879abc0f6cbcb4b58ab3e62ba8bafb2f785",
                    "post_image" => "6c1af77e6fc94019dee57a61ef20a879abc0f6cbcb4b58ab3e62ba8bafb2f785_image.png",
                    "post_text" => "Post text."
                ],
                "Falha ao criar post."
            ]
        ];
    }

    /**
     * Test PostModel::createNewPost
     *
     * @param array $newPostData
     * @param integer|string $expect
     * @return void
     */
    #[DataProvider("createNewPostTestDataProvider")]
    public function testCreateNewPost(array $newPostData, int|string $expect): void
    {
        $this->daoCoreMock->expects($this->once())
            ->method("createData")
            ->with($newPostData)
            ->willReturn($expect);

        $actual = $this->postModel->createNewPost($newPostData);

        // Success creation
        if (is_string($expect)) {
            $this->assertIsString($actual);
            $this->assertEquals($expect, $actual);

        // Failed creation
        } else {
            $this->assertIsInt($expect);
        }
    }
}
