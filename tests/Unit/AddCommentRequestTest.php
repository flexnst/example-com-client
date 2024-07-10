<?php

declare(strict_types=1);

namespace Tests\Unit;

use ExampleCom\Comment;
use ExampleCom\Request\AddCommentRequest;
use GuzzleHttp\Psr7\Uri;
use PHPUnit\Framework\TestCase;

class AddCommentRequestTest extends TestCase
{
    /**
     * @dataProvider commentsDataProvider
     */
    public function testAddCommentRequest(string $name, string $text): void
    {
        $request = new AddCommentRequest(new Comment(
            $name,
            $text,
        ));

        self::assertEquals('POST', $request->getMethod());
        self::assertEquals(new Uri('/comment'), $request->getUri()->getPath());

        $request->getBody()->rewind();

        self::assertEquals(
            '{"name":"' . $name . '","text":"' . $text . '"}',
            $request->getBody()->getContents()
        );
    }

    /**
     * @return array<int, array<int, string>>
     */
    public static function commentsDataProvider(): array
    {
        return [
            ['name1', 'my comment'],
            ['Alice', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'],
            ['Bob', 'Hello!'],
        ];
    }
}