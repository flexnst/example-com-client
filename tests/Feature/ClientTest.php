<?php

declare(strict_types=1);

namespace Tests\Feature;

use ExampleCom\Client;
use ExampleCom\Comment;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;

class ClientTest extends TestCase
{
    public function testAddCommentSuccess(): void
    {
        $exampleCom = $this->mockClient(new Response(200, [], ''));

        self::assertTrue($exampleCom->addComment('Alice', 'Foo'));
    }

    public function testAddCommentError(): void
    {
        $exampleCom = $this->mockClient(new Response(400, [], ''));

        self::assertFalse($exampleCom->addComment('Alice', 'Foo'));
    }

    public function testGetComments(): void
    {
        $exampleCom = $this->mockClient(new Response(200, [], (string) json_encode([
            [
                'id' => 1,
                'name' => 'Alice',
                'text' => 'Foo',
            ],
            [
                'id' => 2,
                'name' => 'Bob',
                'text' => 'Bar',
            ]
        ])));

        $comments = $exampleCom->getComments();

        // Проверим кол-во элементов ответа
        self::assertEquals(2, count($comments));

        // Проверим что первый элемент соответсвует Mock
        self::assertEquals($comments[0], new Comment(
            'Alice',
            'Foo',
            1
        ));

        // Проверим что второй элемент соответсвует Mock
        self::assertEquals($comments[1], new Comment(
            'Bob',
            'Bar',
            2
        ));
    }

    public function testUpdateComment(): void
    {
        $exampleCom = $this->mockClient(new Response(200, [], ''));

        self::assertTrue($exampleCom->updateComment(1,'Alice', 'Foo'));
    }

    private function mockClient(Response $response): Client
    {
        $httpClientMock = $this->createMock(ClientInterface::class);
        $httpClientMock->method('sendRequest')->willReturn($response);

        return new Client($httpClientMock);
    }
}
