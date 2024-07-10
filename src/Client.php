<?php

declare(strict_types=1);

namespace ExampleCom;

use ExampleCom\Exception\UpdateCommentException;
use ExampleCom\Request\AddCommentRequest;
use ExampleCom\Request\GetCommentsRequest;
use ExampleCom\Request\UpdateCommentRequest;
use ExampleCom\Response\GetCommentsResponse;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;

class Client
{
    public function __construct(
        private readonly ClientInterface $httpClient,
    ) {
    }

    /**
     * @return array<Comment>
     * @throws ClientExceptionInterface
     */
    public function getComments(): array
    {
        $response = $this->httpClient->sendRequest(new GetCommentsRequest());

        return (new GetCommentsResponse($response))->getComments();
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function addComment(string $name, string $text): bool
    {
        $response = $this->httpClient
            ->sendRequest(new AddCommentRequest(new Comment($name, $text)));

        return $response->getStatusCode() === 200;
    }

    /**
     * @throws ClientExceptionInterface
     * @throws UpdateCommentException
     * @throws JsonException
     */
    public function updateComment(int $commentId, string $name, string $text): bool
    {
        $response = $this->httpClient
            ->sendRequest(new UpdateCommentRequest(new Comment($name, $text, $commentId)));

        return $response->getStatusCode() === 200;
    }
}