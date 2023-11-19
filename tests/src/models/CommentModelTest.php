<?php

declare(strict_types=1);

namespace tests\models;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\RequiresPhp;
use PHPUnit\Framework\Attributes\RequiresPhpunit;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use src\core\DaoCore;
use src\models\CommentModel;

/**
 * Class CommentModelTest
 * 
 * @package tests\models
 */
#[RequiresPhp("8.2.12")]
#[RequiresPhpunit("10.4")]
class CommentModelTest extends TestCase
{
    /**
     * DaoCore mock object
     *
     * @var DaoCore|MockObject
     */
    private DaoCore|MockObject $daoCoreMock;

    /**
     * CommentModel instance for testing
     *
     * @var CommentModel
     */
    private CommentModel $commentModel;

    /**
     * BoardModelTest::setUp function
     *
     * @return void
     */
    protected function setUp(): void
    {
        $this->daoCoreMock = $this->createMock(DaoCore::class);
        $this->commentModel = new CommentModel($this->daoCoreMock);
    }

    /**
     * CommentModel::createNewComment test data provider
     *
     * @return array
     */
    public static function createNewCommentTestDataProvider(): array
    {
        return [
            "success" => [
                [
                    "comment_parent" => "8h2379f45c0fh8749352n05473n9c28",
                    "comment_owner" => "c1234n7890c12347n890cn1243789",
                    "comment_image" => "c1234n7890c12347n890cn1243789_image.jpg",
                    "comment_text" => "A comment for testing",
                    "comment_created_at" => "99/99/9999 99:99"
                ],
                1
            ],
            "failed" => [
                [
                    "comment_parent" => "8h2379f45c0fh8749352n05473n9c28",
                    "comment_owner" => "c1234n7890c12347n890cn1243789",
                    "comment_image" => "c1234n7890c12347n890cn1243789_image.jpg",
                    "comment_text" => "A comment for testing"
                ],
                "Falha ao criar comentário."
            ]
        ];
    }

    /**
     * Test CommentModel::createNewComment
     *
     * @param array $newCommentData
     * @param integer|string $expect
     * @return void
     */
    #[DataProvider("createNewCommentTestDataProvider")]
    public function testCreateNewComment(
        array $newCommentData,
        int|string $expect
    ): void {
        $this->daoCoreMock->expects($this->once())
            ->method("createData")
            ->with($newCommentData)
            ->willReturn($expect);

        $actual = $this->commentModel->createNewComment($newCommentData);

        // Success
        if (is_int($expect)) {
            $this->assertIsInt($actual);

        // Failed
        } else if (is_string($expect)) {
            $this->assertIsString($actual);
            $this->assertEquals($expect, $actual);
        }
    }
}
