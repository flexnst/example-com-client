<?php

declare(strict_types=1);

use Psr\Http\Client\ClientExceptionInterface;

$psr7httpClient = new \GuzzleHttp\Client([
    'base_uri' => 'https://example.com',
]);

$exampleCom = new \ExampleCom\Client($psr7httpClient);

/**
 * 1. Получить список комментариев
 */
try {
    $comments = $exampleCom->getComments();
} catch (ClientExceptionInterface $exception) {
    // Исключения оставлены на этом уровне для более гибкой обработки ошибок
    // на уровне приложения, использующего данный пакет
    // $logger->error($exception->getMessage(), ...);
}

/**
 * 2. Добавить комментарий
 */
try {
    $exampleCom->addComment('Ivanov Ivan', 'Lorem ipsum dolor.');
} catch (ClientExceptionInterface $exception) {
    // $logger->error($exception->getMessage(), ...);
}

/**
 * 3. Обновить комментарий
 */
try {
    $exampleCom->updateComment(123, 'Ivan Ivanovitch', 'Lorem ipsum dolor sit amet...');
} catch (ClientExceptionInterface $exception) {
    // $logger->error($exception->getMessage(), ...);
} catch (\ExampleCom\Exception\UpdateCommentException $exception) {
    // $logger->error($exception->getMessage(), ...);
}


