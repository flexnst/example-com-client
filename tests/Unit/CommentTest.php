<?php

declare(strict_types=1);

namespace Tests\Unit;

use ExampleCom\Comment;
use PHPUnit\Framework\TestCase;

class CommentTest extends TestCase
{
    /**
     * @param int|null $id
     * @param string $name
     * @param string $text
     * @dataProvider commentsDataProvider
     */
    public function testComment(?int $id, string $name, string $text): void
    {
        $comment = new Comment($name, $text, $id);

        self::assertEquals($id, $comment->id);
        self::assertEquals($name, $comment->name);
        self::assertEquals($text, $comment->text);
    }

    /**
     * @return array<int, array<int, int|null|string>>
     */
    public static function commentsDataProvider(): array
    {
        return [
            [null, 'Vasia', 'Predev'],
            [1, 'Ivan', 'Lorem ipsum'],
            [99999, 'Alice', 'Lorem ipsum dolor sit amet'],
        ];
    }
}