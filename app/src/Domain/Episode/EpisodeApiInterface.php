<?php

declare(strict_types=1);

namespace App\Domain\Episode;

use App\Domain\Episode\Dto\EpisodeInfoDto;

interface EpisodeApiInterface
{
    public function getEpisode(int $id): EpisodeInfoDto;
}
