<?php

declare(strict_types=1);

namespace ExampleCom\Request;

use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;

class GetCommentsRequest extends Request implements RequestInterface
{
    public function __construct()
    {
        parent::__construct('GET', '/comments');
    }
}