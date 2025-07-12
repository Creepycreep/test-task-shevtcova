<?php

declare(strict_types=1);

namespace App\Infrastructure\EpisodeApi;

use App\Domain\Episode\Dto\EpisodeInfoDto;
use App\Domain\Episode\EpisodeApiInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class RickAndMortyEpisodeApiClient implements EpisodeApiInterface
{
    public function __construct(private readonly HttpClientInterface $httpClient)
    {
    }
    private const RICK_AND_MORTY_BASE_API_URL = 'https://rickandmortyapi.com/api';

    public function getEpisode(int $id): EpisodeInfoDto
    {
        $url = self::RICK_AND_MORTY_BASE_API_URL.'/episode/'.(string) $id;
        $response = $this->httpClient->request('GET', $url);

        $data = json_decode($response->getContent(), true);

        $externalId = $data['id'];
        $episodeName = $data['name'];
        $releaseDate = $data['air_date'];

        if (false === is_int($externalId)) {
            throw new \RuntimeException('Invalid episode id');
        }

        if (false === is_string($episodeName) || '' === $episodeName) {
            throw new \RuntimeException('Invalid episode name');
        }

        if (false === is_string($releaseDate) || '' === $releaseDate) {
            throw new \RuntimeException('Invalid date');
        }

        return new EpisodeInfoDto(externalId: $externalId, episodeName: $episodeName, releaseDate: $releaseDate);
    }
}
