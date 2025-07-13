<?php

declare(strict_types=1);

namespace App\Domain\Episode\Service;

use App\Domain\Episode\Episode;
use App\Domain\Episode\EpisodeApiInterface;

readonly class AddEpisodeService
{
    public function __construct(
        private CreateEpisodeService $createEpisodeService,
        private EpisodeApiInterface $episodeApi,
    ) {
    }

    public function add(int $externalId): Episode
    {
        $episodeInfo = $this->episodeApi->getEpisode($externalId);

        return $this->createEpisodeService->create(
            externalId: $externalId,
            episodeName: $episodeInfo->episodeName,
            releaseDate: $this->dateFromString($episodeInfo->releaseDate),
        );
    }

    private function dateFromString(string $date): \DateTimeImmutable
    {
        $date = \DateTimeImmutable::createFromFormat('F j, Y', $date);

        if (false === $date) {
            throw new \InvalidArgumentException('Invalid date format');
        }

        return $date;
    }
}
