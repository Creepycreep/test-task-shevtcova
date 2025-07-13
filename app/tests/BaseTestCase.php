<?php

declare(strict_types=1);

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

abstract class BaseTestCase extends WebTestCase
{
    public function getService(string $id): object
    {
        /** @psalm-var object|null $service */
        $service = static::getContainer()->get($id);

        if (null === $service) {
            throw new ServiceNotFoundException($id);
        }

        if (!$service instanceof $id) {
            throw new \RuntimeException();
        }

        return $service;
    }

    public static function request(string $method, string $url): RequestBuilder
    {
        return new RequestBuilder(client: static::createClient(), method: $method, uri: $url);
    }
}
