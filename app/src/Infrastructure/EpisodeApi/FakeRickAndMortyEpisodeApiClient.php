<?php

declare(strict_types=1);

namespace App\Infrastructure\EpisodeApi;

use App\Domain\Episode\Dto\EpisodeInfoDto;
use App\Domain\Episode\EpisodeApiInterface;

class FakeRickAndMortyEpisodeApiClient implements EpisodeApiInterface
{
    public function getEpisode(int $id): EpisodeInfoDto
    {
        return new EpisodeInfoDto(externalId: $id, episodeName: 'Fake episode name', releaseDate: 'December 2, 2020');
    }
}
