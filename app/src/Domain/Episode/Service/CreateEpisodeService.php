<?php

declare(strict_types=1);

namespace App\Domain\Episode\Service;

use App\Domain\Episode\Episode;
use App\Domain\Episode\Repository\EpisodeRepository;

readonly class CreateEpisodeService
{
    public function __construct(private EpisodeRepository $repository)
    {
    }

    public function create(int $externalId, string $episodeName, \DateTimeImmutable $releaseDate): Episode
    {
        $episode = new Episode(externalId: $externalId, episodeName: $episodeName, releaseDate: $releaseDate);

        $this->repository->add($episode);

        return $episode;
    }
}
