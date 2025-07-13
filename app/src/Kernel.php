<?php

declare(strict_types=1);

namespace App;

use App\Infrastructure\EpisodeApi\RickAndMortyEpisodeApiCompilerPass;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    protected function build(ContainerBuilder $container): void
    {
        parent::build($container);

        $container->addCompilerPass(new RickAndMortyEpisodeApiCompilerPass());
    }
}
