<?php

declare(strict_types=1);

namespace Tests\Unit;

use ExampleCom\Comment;
use ExampleCom\Response\GetCommentsResponse;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class GetCommentsResponseTest extends TestCase
{
    /**
     * @param string $jsonResponse
     * @param array<int, Comment> $comments
     * @dataProvider commentsDataProvider
     */
    public function testGetCommentsResponse(string $jsonResponse, array $comments): void
    {
        $response = new GetCommentsResponse(new Response(200, [], $jsonResponse));

        self::assertEquals($response->getComments(), $comments);
    }

    /**
     * @return array<int, array<int, string|array<int, Comment>>>
     */
    public static function commentsDataProvider(): array
    {
        return [
            [
                '[{"id":1,"name":"aaa","text":"comment 1"},{"id":2,"name":"bbb","text":"comment 2"}]',
                [
                    new Comment('aaa', 'comment 1', 1),
                    new Comment('bbb', 'comment 2', 2),
                ]
            ],
            [
                '[{"id":3,"name":"ccc","text":"comment 3"},{"id":4,"name":"ddd","text":"comment 4"}]',
                [
                    new Comment('ccc', 'comment 3', 3),
                    new Comment('ddd', 'comment 4', 4),
                ]
            ],
        ];
    }
}