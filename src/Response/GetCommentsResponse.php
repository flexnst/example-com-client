<?php

declare(strict_types=1);

namespace ExampleCom\Response;

use ExampleCom\Comment;
use Psr\Http\Message\ResponseInterface;

class GetCommentsResponse
{
    public function __construct(
        private readonly ResponseInterface $response
    ) {
    }

    /**
     * @return array<int, Comment>
     */
    public function getComments(): array
    {
        $this->response->getBody()->rewind();
        /** @var array<int, array<string, string|int>> $json */
        $json = json_decode($this->response->getBody()->getContents(), true);
        $comments = [];

        foreach ($json as $comment) {
            $comments[] = new Comment(
                (string) $comment['name'],
                (string) $comment['text'],
                (int) $comment['id'],
            );
        }

        return $comments;
    }
}