<?php

declare(strict_types=1);

namespace App\Tests\Builder;

use App\Domain\Episode\Episode;
use App\Domain\Episode\Service\CreateEpisodeService;
use Doctrine\ORM\EntityManagerInterface;

readonly class EpisodeBuilder
{
    public function __construct(
        private CreateEpisodeService $createEpisodeService,
        private EntityManagerInterface $entityManager,
    ) {
    }

    public function build(): Episode
    {
        $episode = $this->createEpisodeService->create(
            externalId: 1,
            episodeName: 'name',
            releaseDate: new \DateTimeImmutable(),
        );
        $this->entityManager->flush();

        return $episode;
    }
}
