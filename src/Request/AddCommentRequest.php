<?php

declare(strict_types=1);

namespace ExampleCom\Request;

use ExampleCom\Comment;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;

class AddCommentRequest extends Request implements RequestInterface
{
    public function __construct(Comment $comment)
    {
        $json = json_encode([
            'name' => $comment->name,
            'text' => $comment->text,
        ], JSON_THROW_ON_ERROR);

        parent::__construct('POST', '/comment', [], $json);
    }
}