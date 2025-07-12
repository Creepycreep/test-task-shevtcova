<?php

declare(strict_types=1);

namespace App\Domain\Episode\Dto;

readonly class EpisodeInfoDto
{
    public function __construct(public int $externalId, public string $episodeName, public string $releaseDate)
    {
    }
}
