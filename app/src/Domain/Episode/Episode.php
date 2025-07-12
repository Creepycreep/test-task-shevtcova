<?php

declare(strict_types=1);

namespace App\Domain\Episode;

use App\Domain\Review\Review;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity]
class Episode
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME)]
    public Uuid $id;

    #[ORM\Column(type: Types::INTEGER)]
    public int $externalId;

    #[ORM\Column(type: Types::STRING)]
    public string $episodeName;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    public \DateTimeImmutable $releaseDate;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    public \DateTimeImmutable $createdAt;

    #[ORM\OneToMany(targetEntity: Review::class, mappedBy: 'episode')]
    public Collection $episodeReviews;

    public function __construct(int $externalId, string $episodeName, \DateTimeImmutable $releaseDate)
    {
        $this->id = Uuid::v4();
        $this->createdAt = new \DateTimeImmutable();
        $this->episodeReviews = new ArrayCollection();

        $this->externalId = $externalId;
        $this->episodeName = $episodeName;
        $this->releaseDate = $releaseDate;
    }
}
