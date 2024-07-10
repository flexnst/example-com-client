<?php

declare(strict_types=1);

namespace ExampleCom;

class Comment
{
    public function __construct(
        public string $name,
        public string $text,
        public ?int $id = null,
    ) {
    }
}