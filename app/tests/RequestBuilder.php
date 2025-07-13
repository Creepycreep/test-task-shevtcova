<?php

declare(strict_types=1);

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Component\HttpFoundation\Response;

class RequestBuilder
{
    public function __construct(
        private readonly KernelBrowser $client,
        private readonly string $method,
        private readonly string $uri,
    ) {
    }

    private array $content = [];
    private array $server = [];

    public function execute(): Response
    {
        $this->server['CONTENT_TYPE'] = 'application/json';

        $this->client->request(
            method: $this->method,
            uri: $this->uri,
            server: $this->server,
            content: $this->content ? json_encode($this->content) : null,
        );

        return $this->client->getResponse();
    }

    public function withBody(array $content): self
    {
        $this->content = $content;

        return $this;
    }
}
