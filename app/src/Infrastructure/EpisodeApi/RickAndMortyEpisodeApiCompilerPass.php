<?php

declare(strict_types=1);

namespace App\Infrastructure\EpisodeApi;

use App\Domain\Episode\EpisodeApiInterface;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

class RickAndMortyEpisodeApiCompilerPass implements CompilerPassInterface
{
    private const FAKE_STRATEGY = 'FAKE';
    private const REAL_STRATEGY = 'REAL';

    public function process(ContainerBuilder $container): void
    {
        $strategy = $container->resolveEnvPlaceholders($container->getParameter('rick_and_morty_api_strategy'), true);

        match ($strategy) {
            self::REAL_STRATEGY => $container
                ->setDefinition(EpisodeApiInterface::class, new Definition(RickAndMortyEpisodeApiClient::class))
                ->setArgument('$httpClient', $container->getDefinition('http_client')),
            self::FAKE_STRATEGY => $container->setDefinition(
                EpisodeApiInterface::class,
                new Definition(FakeRickAndMortyEpisodeApiClient::class),
            ),
            default => throw new \InvalidArgumentException(
                sprintf(
                    'Unsupported rick_and_morty_api_strategy value: %s. Possible values: %s, %s',
                    $strategy,
                    self::FAKE_STRATEGY,
                    self::REAL_STRATEGY,
                ),
            ),
        };
    }
}
