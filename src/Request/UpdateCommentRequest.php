<?php

declare(strict_types=1);

namespace ExampleCom\Request;

use ExampleCom\Comment;
use ExampleCom\Exception\UpdateCommentException;
use GuzzleHttp\Psr7\Request;
use JsonException;
use Psr\Http\Message\RequestInterface;

class UpdateCommentRequest extends Request implements RequestInterface
{
    /**
     * @throws UpdateCommentException
     * @throws JsonException
     */
    public function __construct(Comment $comment)
    {
        if (!is_int($comment->id)) {
            throw new UpdateCommentException('Comment id must be an integer.');
        }

        $json = json_encode([
            'name' => $comment->name,
            'text' => $comment->text,
        ], JSON_THROW_ON_ERROR);

        parent::__construct('PUT', "/comment/{$comment->id}", [], $json);
    }
}