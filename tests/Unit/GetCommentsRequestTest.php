<?php

declare(strict_types=1);

namespace Tests\Unit;

use ExampleCom\Request\GetCommentsRequest;
use GuzzleHttp\Psr7\Uri;
use PHPUnit\Framework\TestCase;

class GetCommentsRequestTest extends TestCase
{
    public function testGetCommentsRequest(): void
    {
        $request = new GetCommentsRequest();

        self::assertEquals('GET', $request->getMethod());
        self::assertEquals(new Uri('/comments'), $request->getUri()->getPath());

        $request->getBody()->rewind();

        self::assertEquals('', $request->getBody()->getContents());
    }
}