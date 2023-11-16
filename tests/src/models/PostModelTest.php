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
use stdClass;

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
                [
                    "upload_info" => "upload_info"
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
                [
                    "upload_info" => "upload_info"
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
    public function testCreateNewPost(
        array $newPostData,
        array $imageUploadInfo,
        int|string $expect
    ): void {
        $this->daoCoreMock->expects($this->once())
            ->method("createData")
            ->with($newPostData)
            ->willReturn($expect);

        $actual = $this->postModel->createNewPost($newPostData, $imageUploadInfo);

        // Success creation
        if (is_string($expect)) {
            $this->assertIsString($actual);
            $this->assertEquals($expect, $actual);

            // Failed creation
        } else {
            $this->assertIsInt($expect);
        }
    }

    /**
     * PostModel::getPostByOwner test data provider
     *
     * @return array
     */
    public static function getPostByOwnerTestDataProvider(): array
    {
        return [
            "success_with_data" => [
                new stdClass()
            ],
            "success_no_data" => [
                false
            ],
            "failed" => [
                "Failed to get data. Try again later."
            ]
        ];
    }

    /**
     * Test PostModel::getPostByOwner test
     *
     * @param object|false|string $expect
     * @return void
     */
    #[DataProvider("getPostByOwnerTestDataProvider")]
    public function testGetPostByOwner(object|false|string $expect): void
    {
        $this->daoCoreMock->expects($this->once())
            ->method("getSingleData")
            ->with(
                "*",
                "WHERE post_owner=:post_owner",
                "post_owner=c738fc92b1ea156127e3d90ea34a27a258b799b1f48137da08db091101d7264e"
            )
            ->willReturn($expect);

        $actual = $this->postModel->getPostByOwner("c738fc92b1ea156127e3d90ea34a27a258b799b1f48137da08db091101d7264e");

        // Success with a data 
        if (is_object($expect)) {
            $this->assertIsObject($actual);

        // Success with no data
        } else if ($expect === false) {
            $this->assertFalse($actual);

        // Failed
        } else if (is_string($expect)) {
            $this->assertIsString($actual);
            $this->assertEquals($expect, $actual);
        }
    }
}
