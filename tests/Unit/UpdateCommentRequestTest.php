<?php

declare(strict_types=1);

namespace Tests\Unit;

use ExampleCom\Comment;
use ExampleCom\Exception\UpdateCommentException;
use ExampleCom\Request\UpdateCommentRequest;
use GuzzleHttp\Psr7\Uri;
use PHPUnit\Framework\TestCase;

class UpdateCommentRequestTest extends TestCase
{
    /**
     * @dataProvider commentDataProvider
     */
    public function testAddCommentRequest(string $name, string $text, ?int $commentId): void
    {
        if ($commentId === null) {
            $this->expectException(UpdateCommentException::class);
        }

        $request = new UpdateCommentRequest(new Comment(
            $name,
            $text,
            $commentId
        ));

        self::assertEquals('PUT', $request->getMethod());
        self::assertEquals(new Uri("/comment/{$commentId}"), $request->getUri()->getPath());

        $request->getBody()->rewind();

        self::assertEquals(
            '{"name":"' . $name . '","text":"' . $text . '"}',
            $request->getBody()->getContents()
        );
    }

    /**
     * @return array<int, array<int, int|string|null>>
     */
    public static function commentDataProvider(): array
    {
        return [
            ['name1', 'my comment', 1],
            ['Alice', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', null],
            ['Bob', 'Hello!', 3],
        ];
    }
}