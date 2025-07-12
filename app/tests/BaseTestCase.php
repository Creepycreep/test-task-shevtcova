<?php

namespace App\Tests;

use RuntimeException;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\JsonResponse;

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
            throw new RuntimeException();
        }

        return $service;
    }

    public static function request(string $method, string $url): RequestBuilder
    {
        return new RequestBuilder(client: static::createClient(), method: $method, uri: $url);
    }
}
